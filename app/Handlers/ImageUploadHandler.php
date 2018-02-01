<?php
namespace App\Handlers;

use Image;

class ImageUploadHandler
{
    //允許以下副檔名格式圖片檔案上傳
    protected $allowed_ext = ['png','jpg','jpeg','gif'];
    public function save($file, $folder, $file_prefix,$max_width=false)
    {
        //存檔路徑 uploads/images/avatar/201801/31/
        $folder_name = "uploads/images/$folder/".date("Ym",time()).'/'.date('d',time()).'/';

        //public_path會取到當前項目中public資料夾的位置
        $upload_path = public_path().'/'.$folder_name;

        //判斷圖片副檔名，如不存在就預設為png
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        //將儲存路徑前綴加上該用戶的ID或名稱 1_15599648215_abcdef1234.png
        $filename = $file_prefix.'_'.time().'_'.str_random(10).'.'.$extension;

        //上傳檔案副檔名不為上方所允許的話，將取笑
        if(!in_array($extension,$this->allowed_ext))
        {
            return false;
        }
        //將上傳的圖片移至指定的路徑下
        $file->move($upload_path,$filename);
        return [
            'path' => config('app.url')."/".$folder_name.$filename
        ];
    }

    public function reduceSize($file_path,$max_width)
    {
        //實例化圖片
        $image = Image::make($file_path);

        //進行大小調整
        $image->resize($max_width,null,function ($constraint){

            //設定寬度是$max_width，高度等比例縮放
            $constraint->aspectRatio();

            //防止剪裁時圖片變大
            $constraint->upsize();
        });

        //修改後儲存
        $image->save();
    }
}