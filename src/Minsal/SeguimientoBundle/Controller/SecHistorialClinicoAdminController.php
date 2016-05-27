<?php

namespace Minsal\SeguimientoBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class SecHistorialClinicoAdminController extends CRUDController
{

    public function preinscribirAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        if (!$object) {
            return $this->redirect($this->generateUrl('simagd_imagenologia_digital_registroNoEncontrado'));
        }

        $this->addFlash('sonata_flash_success', 'Preinscribir paciente desde consulta externa: <br/> <strong>' .
						$object->getIdNumeroExpediente()->getIdPaciente() . '</strong>');

        return $this->redirect($this->generateUrl('simagd_solicitud_estudio_create',
                array(
                    '__hcl' => $id,
                    '__exp' => $object->getIdNumeroExpediente()->getId()
                )));
    }
}
