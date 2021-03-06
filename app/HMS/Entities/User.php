<?php

namespace HMS\Entities;

use HMS\Entities\Banking\Account;
use Laravel\Passport\HasApiTokens;
use HMS\Traits\Entities\SoftDeletable;
use HMS\Traits\Entities\Timestampable;
use LaravelDoctrine\ACL\Roles\HasRoles;
use Illuminate\Auth\Passwords\CanResetPassword;
use Doctrine\Common\Collections\ArrayCollection;
use LaravelDoctrine\ORM\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use LaravelDoctrine\ACL\Permissions\HasPermissions;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRoleContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use LaravelDoctrine\ACL\Contracts\HasPermissions as HasPermissionsContract;

class User implements AuthenticatableContract, CanResetPasswordContract, HasRoleContract, HasPermissionsContract, AuthorizableContract
{
    use CanResetPassword, Notifiable, HasRoles, HasPermissions, SoftDeletable, Timestampable, Authorizable, HasApiTokens;

    const MIN_PASSWORD_LENGTH = 3;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string Users first name
     */
    public $name;

    /**
     * @var string Users last name
     */
    protected $lastname;

    /**
     * @var string Users username for login
     */
    protected $username;

    /**
     * @var string Users email address
     */
    public $email;

    /**
     * @var string Users remember me token for persisting login sessions
     */
    protected $rememberToken;

    /**
     * @var \Doctrine\Common\Collections\Collection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    protected $roles;

    /**
     * @var null|Profile The users profile
     */
    protected $profile;

    /**
     * @var null|Account
     */
    protected $account;

    /**
     * @var \Doctrine\Common\Collections\Collection|Email[]
     */
    protected $emails;

    /**
     * User constructor.
     * @param string $firstname
     * @param string $lastname
     * @param string $username
     * @param string $email
     */
    public function __construct(string $firstname, string $lastname, string $username, string $email)
    {
        $this->name = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->roles = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return $this->name . ' ' . $this->lastname;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName(): string
    {
        return 'username';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * Get the password for the user.
     * @return string
     */
    public function getAuthPassword()
    {
        throw new Exception('Not Supported');
    }

    /**
     * Get the token value for the "remember me" session.
     * @return string
     */
    public function getRememberToken(): string
    {
        return $this->{$this->getRememberTokenName()};
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     *
     * @return self
     */
    public function setRememberToken($value): self
    {
        $this->{$this->getRememberTokenName()} = $value;

        return $this;
    }

    /**
     * Get the column name for the "remember me" token.
     * @return string
     */
    public function getRememberTokenName(): string
    {
        return 'rememberToken';
    }

    /**
     * @return ArrayCollection|Role[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return ArrayCollection|Permission[]
     */
    public function getPermissions()
    {
        // user's don't directly have permissions, only via their roles
        return [];
    }

    /**
     * @return null|Profile The users profile
     */
    public function getProfile() : ?Profile
    {
        return $this->profile;
    }

    /**
     * @param null|Profile $profile
     * @return self
     */
    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @return null|Account The users account
     */
    public function getAccount() : ?Account
    {
        return $this->account;
    }

    /**
     * @param null|Account $account
     * @return self
     */
    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * use by passport.
     * @return int
     */
    public function getKey()
    {
        return $this->getAuthIdentifier();
    }

    /**
     * Sets the value of firstname.
     *
     * @param string $firstname the name
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->name = $firstname;

        return $this;
    }

    /**
     * Sets the value of lastname.
     *
     * @param string $lastname the lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Sets the value of email.
     *
     * @param string $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return ArrayCollection|Email[]
     */
    public function getEmails()
    {
        return $this->emails;
    }
}
