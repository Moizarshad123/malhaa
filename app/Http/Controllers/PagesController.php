<?php

namespace App\Http\Controllers;
use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use App\News;
use App\AboutU;
use App\Best;
use App\Testimonial;
use App\GameLevel;
use App\GameRegion;
use App\Order;
use App\Game;
use App\GameRole;
use Illuminate\Support\Facades\Validator;


class PagesController extends Controller
{
    public function Game($slug)
    {
        $gamedata  = Game::where('game_slug',$slug)->first();
        $levels    = GameLevel::where('game_id',$gamedata->id)->orderBy('sequence','ASC')->get();
        $regions   = GameRegion::where('game_id',$gamedata->id)->get();
        $gameroles = GameRole::where('game_id',$gamedata->id)->get();
        return view('pages.vb_game',compact('gamedata','levels','regions','gameroles'));
    }
    // public function CS_GO($slug)
    // {
        
    //     $levels    = GameLevel::where('game_id',1)->get();
    //     $regions   = GameRegion::where('game_id',1)->get();
    //     $bg_img    = Game::select('image','is_role')->where('id',1)->first();
    //     $gameroles = GameRole::where('game_id',1)->get();

    //     // dd($bg_img);
    //     return view('pages.cs_go',compact('levels','regions','bg_img','gameroles'));
    // }
    // public function OverWatch()
    // {
    //     return view('pages.overwatch');
    // }
    public function HomePage()
    {
        // return dd(scandir(public_path()."/models"));
        $models = scandir(public_path()."/models");
        // dd($models[3]);
        // $news = News::skip(0)->take(5)->orderBY('id','DESC')->get();
        // $bests = Best::skip(0)->take(3)->orderBy('id','DESC')->get();
        // $aboutus = AboutU::skip(0)->take(5)->orderBy('id','DESC')->get();
        return view('pages.homepage');
    }
}
