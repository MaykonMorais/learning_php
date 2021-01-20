<?php


namespace Source\Related;


class Company
{
    private $company;
    /* *
     * @var Address
     */
    private $address;
    private $team;
    private $products;


    public function boot($company, Address $address) {
        $this->company = $company;
        $this->address = $address;
    }

    public function bootCompany($company, Address $address) {
        $this->setCompany($company);
        $this->setAddress($address);
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function addTeamMember($job, $firstName, $lastName)
    {
        $this->team[] = new User($job, $firstName, $lastName);
    }
    
    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($products)
    {
        $this->products = $products;
    }


}