<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comment;

class VideoController extends Controller
{
    public function createVideo(){
        return view('video.createvideo');
    }

    public function saveVideo(request $request){
        
        $validateData = $this->validate($request,[
            'title'=>'string|required|min:5|max:50',
            'desc'=>'string|required|min:10|max:300',
            'image' => 'required|mimes:jpeg,bmp,png',
            'video' => 'required|mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime,video/x-flv',

        ]);

        $video = new Video();
        $user = \Auth::user();
        
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('desc');
       
        
        if ( $image = $request->file('image') ):
            $imagePath = $image->getClientOriginalName();
            \Storage::disk('images')->put($imagePath, \File::get($image));
            $video->image = $imagePath;
        endif;
        
        if ( $video_file = $request->file('video') ):
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));
            $video->video_path = $video_path;
        endif;
        
        

        if( $video->save() ):
            return redirect()->route('home')->with([
                'message' => 'Video subido com sucesso'
            ]);
        else:
            return redirect()->route('home')->with([
                'message' => 'não foi possivel realizar upload do video, tente mais tarde
                se o problema persistir contate o adm'
            ]);
        
        endif;



    }
public function getImage($filename){
    $file = Storage::disk('images')->get($filename);

    return new Response($file,200);

}

public function mostrarVideo($videoid){
    $video = Video::find($videoid);
    return view('video.detail',array(
        'video' => $video
    ));
}

public function getVideo($filename){
    $file = Storage::disk('videos')->get($filename);
    return new Response($file,200);
}

public function deleteVideo($videoid){

 
    $user = \Auth::user();
    $video = Video::find($videoid);
   
    $comments = Comment::where('video_id',$videoid)->get();
  

        if( $user && $video->user_id == $user->id ):
           if(count($comments) > 0 ):
                foreach ($comments as $c) {
                    
                    $c->delete();
                }
           endif; 
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);
            $video->delete();
            $message_array = array(
                'message'=>'Video apagado com sucesso'
            );
            
        else:
            $message_array = array(
                'message'=>'Não é possivel apagar este video'
            );   
        endif;
        return redirect()->route('home')->with($message_array);

}

public function searchVideo($search = null){
    
    $videos = Video::where('title','LIKE',"%$search%")->paginate(1);

            return view('video.buscador',array(
                'videos'=>$videos,
                'termo' => $search
            ));

}

}