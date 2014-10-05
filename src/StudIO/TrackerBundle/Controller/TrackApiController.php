<?php
namespace StudIO\TrackerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\Controller\Annotations\View;

use StudIO\TrackerBundle\Entity\Track;

class TrackApiController extends FOSRestController
{

    /**
     * @ApiDoc(
     *  description="Retrieve all Tracks"
     * )
     */
    public function getTracksAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $tracks = $em->getRepository('StudIOTrackerBundle:Track')->findAll();

        $data = array();
        foreach ($tracks as $track) {
            $data[] = $this->formatTrack($track);
        }

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *  description="Process a track"
     * )
     */
    public function getTrackAction()
    {
        $em = $this->getDoctrine()->getManager();
        
		$entity = new Track();
		$entity->setIp($_SERVER['REMOTE_ADDR']);
		$entity->setTimestamp(new \DateTime("now"));
		
		if($this->get('request')->get('ident'))
			$entity->setIdent($this->get('request')->get('ident'));
		
		if($this->get('request')->get('latlong'))
			$entity->setLatlong($this->get('request')->get('latlong'));
		
		$em->persist($entity);
		$em->flush();
		
		$data = $this->formatTrack($entity);

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    private function formatTrack($entity){
        $data = array();

        $data['id']             = $entity->getID();
        $data['ident']          = $entity->getIdent();
        $data['ip']    			= $entity->getIp();
		$data['latlong']    	= $entity->getLatlong();
        $data['timestamp']      = $entity->getTimestamp();

        return $data;
    }

}