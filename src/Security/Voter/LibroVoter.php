<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class LibroVoter extends Voter
{
    public const EDIT = 'LIBRO_EDIT';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::EDIT])
            && $subject instanceof \App\Entity\Libro;
    }

    public function __construct(private AccessDecisionManagerInterface $accessDecisionManager) 
    {

    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token, ?Vote $vote = null): bool
    {
        $utente = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$utente instanceof UserInterface) {
            return false;
        }

        if ($this->accessDecisionManager->decide($token, ['IS_AUTHENTICATED'])){
            return true;
        }

        $vote?->addReason(sprintf("Utente non abilitato alla modifica"));

        return false;
    }
}
