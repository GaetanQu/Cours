<?php

namespace App\DataFixtures;

use App\Entity\Assignment;
use App\Entity\Course;
use App\Entity\File;
use App\Entity\Subject;
use App\Entity\User;
use App\Enum\FileType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $teacher = new User();
        $teacher->setUsername('teacher');
        $teacher->setRoles(['ROLE_TEACHER']);
        $teacher->setPassword('$argon2id$v=19$m=65536,t=4,p=1$Z0Z6b');
        $manager->persist($teacher);

        $student = new User();
        $student->setUsername('student');
        $student->setRoles(['ROLE_STUDENT']);
        $student->setPassword('$argon2id$v=19$m=65536,t=4,p=1$Z0Z6b');
        $manager->persist($student);

        $subject = new Subject();
        $subject->setTitle('Subject');
        $manager->persist($subject);

        $course = new Course();
        $course->setSubject($subject);
        $course->setTitle('Course');
        $course->setCreatedAt(new \DateTimeImmutable());
        $course->setUpdatedAt(new \DateTimeImmutable());
        $manager->persist($course);

        $assignment = new Assignment();
        $assignment->setTitle('Assignment 1');
        $assignment->setDescription('This is the first assignment');
        $assignment->setDueDate(new \DateTimeImmutable());
        $assignment->setDone(false);
        $assignment->setSubject($subject);
        $assignment->setStudent($student);
        $manager->persist($assignment);

        $file = new File();
        $file->setCourse($course);
        $file->setName('Course File');
        $file->setPath('courseFile.pdf');
        $file->setType(FileType::COURSE);
        $manager->persist($file);

        $file2 = new File();
        $file2->setAssignment($assignment);
        $file2->setName('Assignment 1');
        $file2->setPath('assignment1.pdf');
        $file2->setType(FileType::ASSIGNMENT);
        $manager->persist($file2);

        $manager->flush();
    }
}
