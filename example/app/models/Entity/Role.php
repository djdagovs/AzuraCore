<?php
namespace Entity;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * @Table(name="role")
 * @Entity
 */
class Role extends \App\Doctrine\Entity
{
    public function __construct()
    {
        $this->users = new ArrayCollection;
        $this->permissions = new ArrayCollection;
    }
    
    /**
     * @Column(name="id", type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /** @Column(name="name", type="string", length=100) */
    protected $name;

    /** @ManyToMany(targetEntity="User", mappedBy="roles") */
    protected $users;

    /** @OneToMany(targetEntity="Entity\RolePermission", mappedBy="role") */
    protected $permissions;
}