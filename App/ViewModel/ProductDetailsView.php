<?php
declare(strict_types=1);

namespace App\ViewModel;

class ProductDetailsView extends ProductView
{
    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var int
     */
    protected $viewsCounter;

    /**
     * ProductDetailsView constructor.
     *
     * @param string $description
     * @param string $sku
     * @param int    $viewsCounter
     */
    public function __construct(int $id, string $title, string $description, string $sku, int $viewsCounter)
    {
        $this->description  = $description;
        $this->sku          = $sku;
        $this->viewsCounter = $viewsCounter;
        parent::__construct($id, $title);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function getViewsCounter(): int
    {
        return $this->viewsCounter;
    }
}