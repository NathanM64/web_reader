<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Repository\ChapterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChapterController extends AbstractController
{
    /**
     * @Route("/chapter/{id<\d+>}", name="chapter")
     * @param Chapter $chapter
     * @param ChapterRepository $chapterRepository
     * @return Response
     */
    public function chapter(Chapter $chapter, ChapterRepository $chapterRepository): Response
    {
        $nextChapter = $chapterRepository->getNextChapter($chapter);
        $nextChapter != null ? $hasANext = true : $hasANext = false;
        $previousChapter = $chapterRepository->getPreviousChapter($chapter);
        $previousChapter != null ? $hasAPrevious = true : $hasAPrevious = false;

        return $this->render('chapter/chapter.html.twig', [
            'chapter' => $chapter,
            'hasANext' => $hasANext,
            'nextChapter' => $nextChapter,
            'previousChapter' => $previousChapter,
            'hasAPrevious' => $hasAPrevious,
        ]);
    }
}
