<?php

namespace App\Presenters;

use Nette;
use App\Forms\SignFormFactory;
use Kdyby\BootstrapFormRenderer;

/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter {
    
    /**  \App\Model\UserManager 
    public $users;*/

    /**
     * @return Nette\Application\UI\Form
     */
    protected function createComponentSignInForm() {
        $form = new \Nette\Application\UI\Form;
        $form->addText('username', 'Username:')
                ->setRequired('Please enter your username.')
                ->setAttribute('placeholder', 'Username');

        $form->addPassword('password', 'Password:')
                ->setRequired('Please enter your password.')
                ->setAttribute('placeholder', 'Password');

        $form->addSubmit('send', 'Sign')
                ->setAttribute('class', 'btn btn-lg btn-success btn-block');

        $form->onSuccess[] = array($this, 'formSucceeded');
        $this->BootstrapBasicForm($form);
        return $form;
    }
    
    public function formSucceeded($form, $values) {
        try {
            $this->getUser()->login($values->username, $values->password);            
            $this->users->lastLogin($this->user->getId(), $this->getHttpRequest()->getRemoteAddress());
            $this->redirect('Homepage:');
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }

    public function actionOut() {
        $this->getUser()->logout();
        $this->flashMessage('You have been signed out.');
        $this->redirect('in');
    }

}
