<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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

        $sample = null;
        if($this->sample) {
            $sample = [
                'id' => $this->sample->id,
                'name' => $this->sample->name,
                'file' => asset('storage/audios/'.$this->id.'/'. $this->sample->file),
            ];
        }

        $chapters = null;
        if ($this->chapters) {
            foreach($this->chapters as $chapter)
            $chapters[] = [
                'id' => $chapter->id,
                'name' => $chapter->name,
                'file' => asset('storage/audios/' . $this->id . '/' . $chapter->file),
            ];
        }

        $summary = null;
        if ($this->summary) {
            $summary = [
                'id' => $this->summary->id,
                'name' => $this->summary->name,
                'file' => asset('storage/audios/' . $this->id . '/' . $this->summary->file),
            ];
        }

        $podcast = null;
        if ($this->podcast) {
            $podcast = [
                'id' => $this->podcast->id,
                'name' => $this->podcast->name,
                'file' => asset('storage/audios/' . $this->id . '/' . $this->podcast->file),
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'brief' => \html_entity_decode(strip_tags($this->brief)),
            'type' => $this->type,
            'duration' => $this->duration,
            'author' => [
                'id' => $this->author->id,
                'name' => $this->author->name,
            ],
            'narrator' => [
                'id' => $this->narrator->id,
                'name' => $this->narrator->name,
            ],
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'sample' => $sample,
            'chapters' => $chapters,
            'podcast' => $podcast,
            'summary' => $summary,
            'free' => $this->free,
            'demo' => $this->demo,
            'image' => $this->getFirstMediaUrl('book'),
            'thumb' => $this->getFirstMediaUrl('book', 'thumb'),
            'icon' => $this->getFirstMediaUrl('book', 'icon'),
        ];
    }
}
