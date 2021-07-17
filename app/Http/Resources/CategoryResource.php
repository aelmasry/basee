<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent = null;
        $books = null;
        if(!empty($this->parent)) {
            $parent = [
                'id' => $this->parent->id,
                'name' => $this->parent->name
            ];
        }

        if(!empty($this->books)) {
           foreach($this->books as $book) {
                $books[] = [
                    'id' => optional($book)->id,
                    'name' => optional($book)->{'name_'.app()->getLocale()},
                ];
           }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent' => $parent,
            'image' => (count($this->media)) ? $this->getFirstMediaUrl('category') : 0,
            'thumb' => (count($this->media)) ? $this->getFirstMediaUrl('category', 'thumb') : 0,
            'icon' => (count($this->media)) ? $this->getFirstMediaUrl('category', 'icon') : 0,
            'books_count' => $this->books->count(),
            'books' => ($books) ?? 0,
        ];
    }
}
