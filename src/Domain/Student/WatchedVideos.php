<?php

namespace Alura\Calisthenics\Domain\Student;

use Ds\Map;

use Countable;
use DateTimeInterface;
use Alura\Calisthenics\Domain\Video\Video;

class WatchedVideos implements Countable {

    private Map $watchedVideos;

    public function __construct() {
        $this->watchedVideos = new Map();
    }

    public function add(Video $video, DateTimeInterface $date) : void
    {
        $this->watchedVideos->put($video, $date);
    }

    public function count() : int
    {
        return $this->watchedVideos->count();
    }

    public function first()
    {
        $this->watchedVideos->sort(fn (DateTimeInterface $dateA, DateTimeInterface $dateB) => $dateA <=> $dateB);
        
        return $this->watchedVideos->first();
    }
    
}