<?php

namespace Proxies\__CG__\Application\Sonata\UserBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \Application\Sonata\UserBundle\Entity\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'idEstablecimiento', 'idEmpleado', 'idModalidadEstab', 'idAreaModEstab', '' . "\0" . 'Application\\Sonata\\UserBundle\\Entity\\User' . "\0" . 'modulo', 'groups', 'createdAt', 'updatedAt', 'twoStepVerificationCode', 'dateOfBirth', 'firstname', 'lastname', 'website', 'biography', 'gender', 'locale', 'timezone', 'phone', 'facebookUid', 'facebookName', 'facebookData', 'twitterUid', 'twitterName', 'twitterData', 'gplusUid', 'gplusName', 'gplusData', 'token', 'username', 'usernameCanonical', 'email', 'emailCanonical', 'enabled', 'salt', 'password', 'plainPassword', 'lastLogin', 'confirmationToken', 'passwordRequestedAt', 'locked', 'expired', 'expiresAt', 'roles', 'credentialsExpired', 'credentialsExpireAt');
        }

        return array('__isInitialized__', 'id', 'idEstablecimiento', 'idEmpleado', 'idModalidadEstab', 'idAreaModEstab', '' . "\0" . 'Application\\Sonata\\UserBundle\\Entity\\User' . "\0" . 'modulo', 'groups', 'createdAt', 'updatedAt', 'twoStepVerificationCode', 'dateOfBirth', 'firstname', 'lastname', 'website', 'biography', 'gender', 'locale', 'timezone', 'phone', 'facebookUid', 'facebookName', 'facebookData', 'twitterUid', 'twitterName', 'twitterData', 'gplusUid', 'gplusName', 'gplusData', 'token', 'username', 'usernameCanonical', 'email', 'emailCanonical', 'enabled', 'salt', 'password', 'plainPassword', 'lastLogin', 'confirmationToken', 'passwordRequestedAt', 'locked', 'expired', 'expiresAt', 'roles', 'credentialsExpired', 'credentialsExpireAt');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdEstablecimiento(\Minsal\SiapsBundle\Entity\CtlEstablecimiento $idEstablecimiento = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdEstablecimiento', array($idEstablecimiento));

        return parent::setIdEstablecimiento($idEstablecimiento);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdEstablecimiento()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdEstablecimiento', array());

        return parent::getIdEstablecimiento();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function addGroup(\FOS\UserBundle\Model\GroupInterface $groups)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addGroup', array($groups));

        return parent::addGroup($groups);
    }

    /**
     * {@inheritDoc}
     */
    public function removeGroup(\FOS\UserBundle\Model\GroupInterface $groups)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeGroup', array($groups));

        return parent::removeGroup($groups);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroups()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroups', array());

        return parent::getGroups();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdEmpleado(\Minsal\SiapsBundle\Entity\MntEmpleado $idEmpleado = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdEmpleado', array($idEmpleado));

        return parent::setIdEmpleado($idEmpleado);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdEmpleado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdEmpleado', array());

        return parent::getIdEmpleado();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdModalidadEstab(\Minsal\SiapsBundle\Entity\MntModalidadEstablecimiento $idModalidadEstab = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdModalidadEstab', array($idModalidadEstab));

        return parent::setIdModalidadEstab($idModalidadEstab);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdModalidadEstab()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdModalidadEstab', array());

        return parent::getIdModalidadEstab();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdAreaModEstab(\Minsal\SiapsBundle\Entity\MntAreaModEstab $idAreaModEstab = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdAreaModEstab', array($idAreaModEstab));

        return parent::setIdAreaModEstab($idAreaModEstab);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdAreaModEstab()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdAreaModEstab', array());

        return parent::getIdAreaModEstab();
    }

    /**
     * {@inheritDoc}
     */
    public function setModulo($modulo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setModulo', array($modulo));

        return parent::setModulo($modulo);
    }

    /**
     * {@inheritDoc}
     */
    public function getModulo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getModulo', array());

        return parent::getModulo();
    }

    /**
     * {@inheritDoc}
     */
    public function prePersist()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'prePersist', array());

        return parent::prePersist();
    }

    /**
     * {@inheritDoc}
     */
    public function preUpdate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'preUpdate', array());

        return parent::preUpdate();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTime $createdAt = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', array($createdAt));

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', array());

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', array($updatedAt));

        return parent::setUpdatedAt($updatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', array());

        return parent::getUpdatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getExpiresAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExpiresAt', array());

        return parent::getExpiresAt();
    }

    /**
     * {@inheritDoc}
     */
    public function getCredentialsExpireAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCredentialsExpireAt', array());

        return parent::getCredentialsExpireAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCredentialsExpireAt(\DateTime $date = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCredentialsExpireAt', array($date));

        return parent::setCredentialsExpireAt($date);
    }

    /**
     * {@inheritDoc}
     */
    public function setGroups($groups)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGroups', array($groups));

        return parent::setGroups($groups);
    }

    /**
     * {@inheritDoc}
     */
    public function setTwoStepVerificationCode($twoStepVerificationCode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTwoStepVerificationCode', array($twoStepVerificationCode));

        return parent::setTwoStepVerificationCode($twoStepVerificationCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getTwoStepVerificationCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTwoStepVerificationCode', array());

        return parent::getTwoStepVerificationCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setBiography($biography)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBiography', array($biography));

        return parent::setBiography($biography);
    }

    /**
     * {@inheritDoc}
     */
    public function getBiography()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBiography', array());

        return parent::getBiography();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateOfBirth($dateOfBirth)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateOfBirth', array($dateOfBirth));

        return parent::setDateOfBirth($dateOfBirth);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateOfBirth()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateOfBirth', array());

        return parent::getDateOfBirth();
    }

    /**
     * {@inheritDoc}
     */
    public function setFacebookData($facebookData)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFacebookData', array($facebookData));

        return parent::setFacebookData($facebookData);
    }

    /**
     * {@inheritDoc}
     */
    public function getFacebookData()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFacebookData', array());

        return parent::getFacebookData();
    }

    /**
     * {@inheritDoc}
     */
    public function setFacebookName($facebookName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFacebookName', array($facebookName));

        return parent::setFacebookName($facebookName);
    }

    /**
     * {@inheritDoc}
     */
    public function getFacebookName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFacebookName', array());

        return parent::getFacebookName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFacebookUid($facebookUid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFacebookUid', array($facebookUid));

        return parent::setFacebookUid($facebookUid);
    }

    /**
     * {@inheritDoc}
     */
    public function getFacebookUid()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFacebookUid', array());

        return parent::getFacebookUid();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstname($firstname)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstname', array($firstname));

        return parent::setFirstname($firstname);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstname()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstname', array());

        return parent::getFirstname();
    }

    /**
     * {@inheritDoc}
     */
    public function setGender($gender)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGender', array($gender));

        return parent::setGender($gender);
    }

    /**
     * {@inheritDoc}
     */
    public function getGender()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGender', array());

        return parent::getGender();
    }

    /**
     * {@inheritDoc}
     */
    public function setGplusData($gplusData)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGplusData', array($gplusData));

        return parent::setGplusData($gplusData);
    }

    /**
     * {@inheritDoc}
     */
    public function getGplusData()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGplusData', array());

        return parent::getGplusData();
    }

    /**
     * {@inheritDoc}
     */
    public function setGplusName($gplusName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGplusName', array($gplusName));

        return parent::setGplusName($gplusName);
    }

    /**
     * {@inheritDoc}
     */
    public function getGplusName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGplusName', array());

        return parent::getGplusName();
    }

    /**
     * {@inheritDoc}
     */
    public function setGplusUid($gplusUid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGplusUid', array($gplusUid));

        return parent::setGplusUid($gplusUid);
    }

    /**
     * {@inheritDoc}
     */
    public function getGplusUid()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGplusUid', array());

        return parent::getGplusUid();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastname($lastname)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastname', array($lastname));

        return parent::setLastname($lastname);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastname()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastname', array());

        return parent::getLastname();
    }

    /**
     * {@inheritDoc}
     */
    public function setLocale($locale)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLocale', array($locale));

        return parent::setLocale($locale);
    }

    /**
     * {@inheritDoc}
     */
    public function getLocale()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLocale', array());

        return parent::getLocale();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhone($phone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhone', array($phone));

        return parent::setPhone($phone);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhone', array());

        return parent::getPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setTimezone($timezone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTimezone', array($timezone));

        return parent::setTimezone($timezone);
    }

    /**
     * {@inheritDoc}
     */
    public function getTimezone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTimezone', array());

        return parent::getTimezone();
    }

    /**
     * {@inheritDoc}
     */
    public function setTwitterData($twitterData)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTwitterData', array($twitterData));

        return parent::setTwitterData($twitterData);
    }

    /**
     * {@inheritDoc}
     */
    public function getTwitterData()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTwitterData', array());

        return parent::getTwitterData();
    }

    /**
     * {@inheritDoc}
     */
    public function setTwitterName($twitterName)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTwitterName', array($twitterName));

        return parent::setTwitterName($twitterName);
    }

    /**
     * {@inheritDoc}
     */
    public function getTwitterName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTwitterName', array());

        return parent::getTwitterName();
    }

    /**
     * {@inheritDoc}
     */
    public function setTwitterUid($twitterUid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTwitterUid', array($twitterUid));

        return parent::setTwitterUid($twitterUid);
    }

    /**
     * {@inheritDoc}
     */
    public function getTwitterUid()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTwitterUid', array());

        return parent::getTwitterUid();
    }

    /**
     * {@inheritDoc}
     */
    public function setWebsite($website)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setWebsite', array($website));

        return parent::setWebsite($website);
    }

    /**
     * {@inheritDoc}
     */
    public function getWebsite()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWebsite', array());

        return parent::getWebsite();
    }

    /**
     * {@inheritDoc}
     */
    public function setToken($token)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setToken', array($token));

        return parent::setToken($token);
    }

    /**
     * {@inheritDoc}
     */
    public function getToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getToken', array());

        return parent::getToken();
    }

    /**
     * {@inheritDoc}
     */
    public function getFullname()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFullname', array());

        return parent::getFullname();
    }

    /**
     * {@inheritDoc}
     */
    public function getRealRoles()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRealRoles', array());

        return parent::getRealRoles();
    }

    /**
     * {@inheritDoc}
     */
    public function setRealRoles(array $roles)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRealRoles', array($roles));

        return parent::setRealRoles($roles);
    }

    /**
     * {@inheritDoc}
     */
    public function addRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addRole', array($role));

        return parent::addRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'serialize', array());

        return parent::serialize();
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($serialized)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'unserialize', array($serialized));

        return parent::unserialize($serialized);
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'eraseCredentials', array());

        return parent::eraseCredentials();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsername', array());

        return parent::getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsernameCanonical()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsernameCanonical', array());

        return parent::getUsernameCanonical();
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalt', array());

        return parent::getSalt();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', array());

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailCanonical()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailCanonical', array());

        return parent::getEmailCanonical();
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', array());

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function getPlainPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlainPassword', array());

        return parent::getPlainPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastLogin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastLogin', array());

        return parent::getLastLogin();
    }

    /**
     * {@inheritDoc}
     */
    public function getConfirmationToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConfirmationToken', array());

        return parent::getConfirmationToken();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRoles', array());

        return parent::getRoles();
    }

    /**
     * {@inheritDoc}
     */
    public function hasRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasRole', array($role));

        return parent::hasRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function isAccountNonExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAccountNonExpired', array());

        return parent::isAccountNonExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isAccountNonLocked()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAccountNonLocked', array());

        return parent::isAccountNonLocked();
    }

    /**
     * {@inheritDoc}
     */
    public function isCredentialsNonExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isCredentialsNonExpired', array());

        return parent::isCredentialsNonExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isCredentialsExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isCredentialsExpired', array());

        return parent::isCredentialsExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isEnabled()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isEnabled', array());

        return parent::isEnabled();
    }

    /**
     * {@inheritDoc}
     */
    public function isExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isExpired', array());

        return parent::isExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isLocked()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isLocked', array());

        return parent::isLocked();
    }

    /**
     * {@inheritDoc}
     */
    public function isSuperAdmin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isSuperAdmin', array());

        return parent::isSuperAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function isUser(\FOS\UserBundle\Model\UserInterface $user = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isUser', array($user));

        return parent::isUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function removeRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeRole', array($role));

        return parent::removeRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsername', array($username));

        return parent::setUsername($username);
    }

    /**
     * {@inheritDoc}
     */
    public function setUsernameCanonical($usernameCanonical)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsernameCanonical', array($usernameCanonical));

        return parent::setUsernameCanonical($usernameCanonical);
    }

    /**
     * {@inheritDoc}
     */
    public function setCredentialsExpired($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCredentialsExpired', array($boolean));

        return parent::setCredentialsExpired($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', array($email));

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailCanonical($emailCanonical)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailCanonical', array($emailCanonical));

        return parent::setEmailCanonical($emailCanonical);
    }

    /**
     * {@inheritDoc}
     */
    public function setEnabled($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEnabled', array($boolean));

        return parent::setEnabled($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setExpired($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpired', array($boolean));

        return parent::setExpired($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setExpiresAt(\DateTime $date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpiresAt', array($date));

        return parent::setExpiresAt($date);
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', array($password));

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function setSuperAdmin($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSuperAdmin', array($boolean));

        return parent::setSuperAdmin($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setPlainPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlainPassword', array($password));

        return parent::setPlainPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function setLastLogin(\DateTime $time)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastLogin', array($time));

        return parent::setLastLogin($time);
    }

    /**
     * {@inheritDoc}
     */
    public function setLocked($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLocked', array($boolean));

        return parent::setLocked($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setConfirmationToken($confirmationToken)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setConfirmationToken', array($confirmationToken));

        return parent::setConfirmationToken($confirmationToken);
    }

    /**
     * {@inheritDoc}
     */
    public function setPasswordRequestedAt(\DateTime $date = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPasswordRequestedAt', array($date));

        return parent::setPasswordRequestedAt($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getPasswordRequestedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPasswordRequestedAt', array());

        return parent::getPasswordRequestedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function isPasswordRequestNonExpired($ttl)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isPasswordRequestNonExpired', array($ttl));

        return parent::isPasswordRequestNonExpired($ttl);
    }

    /**
     * {@inheritDoc}
     */
    public function setRoles(array $roles)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRoles', array($roles));

        return parent::setRoles($roles);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupNames()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupNames', array());

        return parent::getGroupNames();
    }

    /**
     * {@inheritDoc}
     */
    public function hasGroup($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasGroup', array($name));

        return parent::hasGroup($name);
    }

}
