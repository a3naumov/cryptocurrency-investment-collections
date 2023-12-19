<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\User\Status;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(
        name: 'id',
        type: Types::INTEGER,
        unique: true,
        nullable: false,
    )]
    private int $id;

    #[ORM\Column(
        name: 'email',
        type: Types::STRING,
        length: 180,
        unique: true,
        nullable: false,
    )]
    private string $email;

    #[ORM\Column(
        name: 'roles',
        type: Types::JSON,
        unique: false,
        nullable: false,
    )]
    private array $roles = [];

    #[ORM\Column(
        name: 'password',
        type: Types::STRING,
        length: 255,
        unique: false,
        nullable: false,
    )]
    private string $password;

    #[ORM\Column(
        name: 'status',
        type: Types::SMALLINT,
        unique: false,
        nullable: false,
        enumType: Status::class,
        options: [
            'default' => Status::Pending,
            'unsigned' => true,
        ],
    )]
    private Status $status = Status::Pending;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param string[] $roles
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
        return;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): User
    {
        $this->status = $status;

        return $this;
    }
}
