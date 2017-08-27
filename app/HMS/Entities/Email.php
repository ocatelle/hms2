<?php

namespace HMS\Entities;

use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;

class Email
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var array
     */
    protected $toAddress;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $body;

    /*
     * @var Carbon
     */
    protected $sentAt;

    /**
     * @var \Doctrine\Common\Collections\Collection|Users[]
     */
    protected $users;

    /**
     * @var null|Role
     */
    protected $role;

    /**
     * Create a new email record.
     * @param array  $toAddress      Array of to adddress in format [ email => name]
     * @param string $subject
     * @param string $body
     */
    public function __construct(array $toAddress, string $subject, string $body)
    {
        $this->toAddress = $toAddress;
        $this->subject = $subject;
        $this->body = $body;
        $this->users = new ArrayCollection();
        $this->sentAt = Carbon::now();
    }

    /**
     * Gets the value of id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the value of to.
     *
     * @return array
     */
    public function getTo(): array
    {
        return $this->toAddress;
    }

    /**
     * Sets the value of to.
     *
     * @param array $toAddress the to
     *
     * @return self
     */
    public function setTo(array $toAddress): Email
    {
        $this->toAddress = $toAddress;

        return $this;
    }

    /**
     * Gets the value of subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Sets the value of subject.
     *
     * @param string $subject the subject
     *
     * @return self
     */
    public function setSubject(string $subject): Email
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Gets the value of body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Sets the value of body.
     *
     * @param string $body the body
     *
     * @return self
     */
    public function setBody($body): Email
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Gets the value of sentAt.
     *
     * @return string
     */
    public function getSentAt(): Carbon
    {
        return $this->sentAt;
    }

    /**
     * Sets the value of sentAt.
     *
     * @param Carbon $sentAt the sent at
     *
     * @return self
     */
    public function setSentAt($sentAt): Email
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Gets the value of users.
     *
     * @return \Doctrine\Common\Collections\Collection|Users[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Gets the value of role.
     *
     * @return null|Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Sets the value of role.
     *
     * @param null|Role $role the role
     *
     * @return self
     */
    public function setRole(?Role $role): Email
    {
        $this->role = $role;

        return $this;
    }
}
