<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\MediaObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostImageController
 {
    public function __invoke(Request $request): MediaObject
    {
        //  dd( $request ->attributes);
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;

        return $mediaObject;
        
    }
 }

         // dd( $request ->attributes);
        //  $etd = $request ->attributes->get('data');
        //  if(!($etd instanceof Etudiant))
        //  {
        //      throw new \RuntimeException('Etudiant attendu');
        //  }
        
        //  $file  = $request->files->get('file');
        //  $etd->setFile($request->files->get('file'));
        //  dd($file,$etd);
?>
