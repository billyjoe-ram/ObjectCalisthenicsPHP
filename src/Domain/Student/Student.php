<?php

namespace Alura\Calisthenics\Domain\Student;

use DateTimeInterface;

use Alura\Calisthenics\Domain\Email\Email;
use Alura\Calisthenics\Domain\Video\Video;

class Student
{
    private Email $email;
    private DateTimeInterface $birthDate;
    private WatchedVideos $watchedVideos;
    public StudentFullName $fullName;
    private StudentAddress $address;

    public function __construct(
        Email $email,
        DateTimeInterface $birthDate,
        StudentFullName $fullName,
        StudentAddress $address
    )
    {
        $this->watchedVideos = new WatchedVideos();
        $this->email = $email;
        $this->birthDate = $birthDate;
        $this->fullName = $fullName;
        $this->address = $address;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBirthDate(): DateTimeInterface
    {
        return $this->birthDate;
    }

    public function getAge(): int
    {
        $today = new \DateTimeImmutable();
        $dateInterval = $this->getBirthDate()->diff($today);
        
        return $dateInterval->y;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->add($video, $date);
    }

    public function hasAccess(): bool
    {
        if (!$this->watchedVideos->count()) {
            return true;
        }

        return $this->firstVideoWatchedInLessThan90Days();
    }

    private function firstVideoWatchedInLessThan90Days()
    {
        /** @var DateTimeInterface $firstDate */
        $firstDate = $this->watchedVideos->first()->value;
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;
    }
}
