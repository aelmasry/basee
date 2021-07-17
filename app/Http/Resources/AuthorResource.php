<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $books = null;
        if (!empty($this->books)) {
            foreach ($this->books as $book) {
                $books[] = [
                    'id' => optional($book)->id,
                    'name' => optional($book)->{'name_' . app()->getLocale()},
                ];
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'brief' => \html_entity_decode(strip_tags($this->brief)),
            'books_count' => $this->books->count(),
            'books' => ($books) ?? 0,
            'image' => $this->getFirstMediaUrl('image'),
            'thumb' => $this->getFirstMediaUrl('image', 'thumb'),
            'icon' => $this->getFirstMediaUrl('image', 'icon'),
        ];
    }
}
