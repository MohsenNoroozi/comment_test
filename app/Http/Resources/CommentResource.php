<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->when(!is_null($this['id']), $this['id']),
            'user_name' => $this->when(!is_null($this['user_name']), $this['user_name']),
            'comment_text' => $this->when(!is_null($this['comment_text']), $this['comment_text']),
            'created_at' => $this->when(!is_null($this['created_at']), $this['created_at']),
            'parent_id' => $this->when(!is_null($this['parent_id']), $this['parent_id']),

            'children' => CommentResource::collection($this->whenLoaded('children')),
        ];
    }
}
