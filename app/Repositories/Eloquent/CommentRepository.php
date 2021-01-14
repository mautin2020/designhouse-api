<?php
namespace App\Repositories\Eloquent;
use App\Models\Comment;
use App\Repositories\Contracts\IComment;
use App\Repositories\Contracts\IDesign;

class CommentRepository extends BaseRepository implements IComment 
{
    
    public function model()
   {
       return Comment::class;
   }
}