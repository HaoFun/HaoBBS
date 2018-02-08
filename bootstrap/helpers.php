<?PHP

//route_class() 返回目前請求的路由名稱
function route_class()
{
    return str_replace('.','-',Route::currentRouteName());
}

function make_excerpt($value,$length=200)
{
    //過濾空格，匹配出換行則替換掉   strip_tags()去除HTML標籤
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/','',strip_tags($value)));
    return str_limit($excerpt,$length);
}