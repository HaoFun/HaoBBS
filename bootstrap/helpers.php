<?PHP

//route_class() 返回目前請求的路由名稱
function route_class()
{
    return str_replace('.','-',Route::currentRouteName());
}