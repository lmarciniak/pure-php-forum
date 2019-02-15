<?php
namespace Forum\Utilities;

class Paginator 
{
    private $items = [];
    private $currentPage;
    private $limit;
    private $amount;
    private $lastPage;

    /**
     * @param int $page Current page
     * @param int $limit Number of items to display
     * @param int $amount Number of rows
     */
    public function __construct(int $page, int $limit = 1, int $amount = 1) 
    {
        $this->currentPage = $this->setCurrentPage($page);
    }

    /**
     * @param int $limit Limit of fetched rows
     */
    public function setLimit(int $limit) 
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $amount Amount of rows
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    /**
     * @param int $page Current page
     * @return bool
     */
    public function isValidPageNumber(int $page): bool 
    {
        if (!isset($page) || !Validator::match($page, "/[0-9]/") || $page < 1) {
            return false;
        } else if (filter_var($page, FILTER_VALIDATE_INT)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $page Current page
     * @return int
     */
    public function setCurrentPage(int $page): int
    {
        if ($this->isValidPageNumber($page)) 
            return $page;
        else 
            return 1;
    }

    public function setItems() 
    {
        $this->lastPage = ceil($this->amount / $this->limit);
        if ($this->lastPage == 1) {
            $this->items = null;
        } else {
            if ($this->currentPage > 4)
                $this->items['first page'] = '?page=1';
            for ($i = $this->currentPage - 3; $i <= $this->currentPage + 3; $i++) {
                if ($i > $this->lastPage) {
                    break;
                } else if ($i < 1) {
                    continue;
                } else {
                    $this->items[$i] = "?page=$i";
                }
            }
            if ($this->currentPage < $this->lastPage - 3)
                $this->items['last page'] = "?page=$this->lastPage";
        }
    }

    /**
     * @return array
     */
    public function getItems(): ?array
    {
        $this->setItems();
        return $this->items;
    }

    public function getItemsJSON() 
    {
        return json_encode($this->items);
    }
}