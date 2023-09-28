<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method load(string $string)
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            //تقوم بجلبه ولاكن عند التحميل فقط في الكنترول
            'tasks'=>TaskResource::collection($this->whenLoaded('tasks'))
        ];
    }
}
