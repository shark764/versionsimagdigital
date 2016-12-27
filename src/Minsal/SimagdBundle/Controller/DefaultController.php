<?php

namespace Minsal\SimagdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
    public function jalarEstudiosAction(Request $request)
    {
        /** numero de expediente local (estab preinscriptor) */
        $numeroExpedienteLocal = $request->request->get('numeroExpedienteLocal');
        
        /** Establecimiento local (a partir del userSession) */
        $estabLocal = $this->container->get('security.context')->getToken()->getUser()->getIdEstablecimiento()->getId();
        
        /** EntityManager */
        $em = $this->getDoctrine()->getManager();
        
        /** Registro de expediente local (buscado a partir del numero y establecimiento local) */
        $expedienteEntity = $em->getRepository('MinsalSimagdBundle:MntExpediente')->findOneBy(array(
                                                                                                    'numero' => $numeroExpedienteLocal,
                                                                                                    'idEstablecimiento' => $estabLocal
                                                                                                ));
        /** Paciente al que pertenecen todos los expedientes buscados */
        $pacienteEntity = $expedienteEntity->getIdPaciente();
        
        /** Establecimientos en donde se ha realizado estudios al paciente */
        $estabsEstudiosRealizados = $em->getRepository('MinsalSimagdBundle:ImgEstudioPaciente')
                                            ->obtenerEstabsEstudiosRealizados($pacienteEntity->getId());
        
        /** Array multidimensional que contendra todos los 'numero' de expedientes y el establecimiento al que pertenecen */
        $numerosExpedientesEstabsArray = array();
        
        /** Recorrer todos los establecimientos para obtener el 'numero' de expediente en cada uno */
        foreach ($estabsEstudiosRealizados as $estabEstudioRz)  {
            /** Obtener registro de expediente del establecimiento (buscado por paciente y establecimiento) */
            $expedienteEstabRealizado = $em->getRepository('MinsalSimagdBundle:MntExpediente')->findOneBy(array(
                                                                                                    'idPaciente' => $pacienteEntity->getId(),
                                                                                                    'idEstablecimiento' => $estabEstudioRz->getId()
                                                                                                ));
            /** guardar 'numero' y establecimiento al que pertenece */
            $resultado['numeroExpediente'] = $expedienteEstabRealizado->getNumero();
            $resultado['establecimientoRealizado'] = $estabEstudioRz->getId();
            
            /** Almacenar en array */
            $numerosExpedientesEstabsArray[] = $resultado;
        }
        
        /** Ahora $numerosExpedientesEstabsArray contiene todos los numeros de expediente y el establecimiento al que pertenecen */
        
    }
    
}
