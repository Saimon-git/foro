<?php

namespace App\Http\Controllers;

use App\{Post, Category};
use Illuminate\Http\Request;

class ListPostController extends Controller
{
    public function __invoke(Category $category = null, Request $request)
    {
        

        list($orderColumn, $orederDirection) = $this->getListOrder($request->get('orden'));

        $posts = Post::query()
            ->with(['user','category'])
            ->category($category)
            ->scopes($this->getRouteScope($request))
            ->orderBy($orderColumn, $orederDirection)
            ->paginate()
            ->appends($request->intersect(['orden']));
        

        return view('posts.index', compact('posts', 'category'));
    }    
/* 
    protected function getListScopes(Category $category, Request $request)
    {
        $scopes = $this->getRouteScope($request);

        
        $scopes['category'] = [$category];
        
        return $scopes;
    } */

    protected function getRouteScope(Request $request)
    {
        $scopes = [
            'posts.mine' => ['byUser' => [$request->user()]],
            'posts.pending' => ['pending'],
            'posts.completed' => ['completed']
        ];
        
        return $scopes[$request->route()->getName()] ?? [];
        //return isset($scopes[$name]) ? $scopes[$name] : [];

    }

    protected function getListOrder($order)
    {
        $orders = [
            'recientes' => ['created_at', 'desc'],
            'antiguos'  => ['created_at', 'asc'],
        ];
        
        return $orders[$order] ??  ['created_at', 'desc'];
    }
}
