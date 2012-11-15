<?php

// application/controllers/GuestbookController.php

class GuestbookController extends Zend_Controller_Action
{

    public function indexAction()
    {
        $defaultNamespace = new Zend_Session_Namespace('Default');
        if (isset($defaultNamespace->numberOfPageRequests)) {
            $defaultNamespace->numberOfPageRequests++;
        } else {
            $defaultNamespace->numberOfPageRequests = 1; // Erster Zugriff
        }
        $guestbook = new Application_Model_GuestbookMapper();
        $this->view->entries = $guestbook->fetchAll();
    }

    public function signAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Guestbook();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Guestbook($form->getValues());
                $mapper  = new Application_Model_GuestbookMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }
}

