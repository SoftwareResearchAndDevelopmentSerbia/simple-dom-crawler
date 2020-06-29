<?php

require_once 'simple_html_dom.php';

const PRODUCT_ITEM              = 'div[class=product-item]';
const PRODUCT_SKU               = 'h3[class=product-sku]';
const PRODUCT_TITLE             = 'h2[class=product-title]';
const PRODUCT_OBJECT_ID         = 'data-productid';
const PRODUCT_IMG_WRAPPER       = 'div[class=product-image-wrapper]';
const PRODUCT_VARIANTS_HTML     = 'table[class=product-variant-table]';
const PRODUCT_VARIANTS_ROWS     = 'tr[class=product-variant-line]';

const VARIANT_SKU               = 'td[class=variant-sku]';
const VARIANT_DESCRIPTION       = 'td[class=variant-description]';
const VARIANT_PQ                = 'td[class=variant-pq]';
const VARIANT_PRICE             = 'td[class=variant-price]';
const VARIANT_AVAILABLE_QTY     = 'td[class=variant-availablequantity]';
const VARIANT_QTY               = 'td[class=variant-quantity]';

const CRAWLED_URL               = 'test_page/index.html';
const CRAWLED_DETAILS_TEST_URL  = 'test_page/beakers-griffin-low-form-double-scale-graduated-pyrex/index.html';

$scraped_products_collection    = [];

/**
 * Class ScrapedProduct
 */
class ScrapedProduct
{
    private $_id                = null;
    private $_sku               = null;
    private $_title             = '';
    private $_details_url       = '';
    private $_image_url         = '';
    private $_product_variants  = [];
    private $_product_index     = 0;

    public function __construct(
        int     $id             = null,
        string  $sku            = '',
        string  $title          = '',
        string  $details_url    = '',
        string  $image_url      = '',
        int     $product_index  = 0
    ) {
        $this->_id              = $id;
        $this->_sku             = $sku;
        $this->_title           = $title;
        $this->_details_url     = $details_url;
        $this->_image_url       = $image_url;
        $this->_product_index   = $product_index;

        /**
         * Local Debug Statement
         * For first two products use local details url
         */
        if ($this->_product_index === 0 || $this->_product_index === 1)
        {
            $this->setDetailsUrl(CRAWLED_DETAILS_TEST_URL);
        }

        $this->getProductVariants();
    }

    public function setDetailsUrl(string $details_url = '')
    {
        $this->_details_url = $details_url;
    }

    public function setProductVariants(array $product_variants = [])
    {
        $this->_product_variants = $product_variants;
    }

    public function getProductVariants()
    {
        $variants_html      = file_get_html($this->_details_url);
        $variants_table     = $variants_html->find(PRODUCT_VARIANTS_HTML);

        // Debug - Get Variants Table Html Structure
        // echo "<pre>";
        // $variants_table->dump(true);
        // echo "</pre>";

        $product_variants   = [];
        foreach ($variants_table[0]->find(PRODUCT_VARIANTS_ROWS) as $key_2 => $table_row)
        {
            $product_variants[] = [
                'variant_sku'           => $table_row->find(VARIANT_SKU)[0]->text(),
                'variant_description'   => $table_row->find(VARIANT_DESCRIPTION)[0]->text(),
                'variant_pq'            => $table_row->find(VARIANT_PQ)[0]->text(),
                'varinat_price'         => $table_row->find(VARIANT_PRICE)[0]->text(),
                'variant_available_qty' => $table_row->find(VARIANT_AVAILABLE_QTY)[0]->text(),
                'variant_qty'           => $table_row->find(VARIANT_QTY)[0]->text()
            ];
        }
        $this->setProductVariants($product_variants);

        unset($product_variants);
        unset($variants_table);
        unset($variants_html);
    }
}

/**
 * Crawl Script Begin
 */
$html           = file_get_html(CRAWLED_URL);
$product_items  = $html->find(PRODUCT_ITEM);

foreach ($product_items as $key => $product_item)
{
    /**
     * Local Debug Statement
     * Skip all products except the first two
     */
    if ($key >= 2)
    {
        continue;
    }

    // Debug - Get Product Html Structure
    // echo "<pre>";
    // $product_item->dump(true);
    // echo "</pre>";

    $scrpr = new ScrapedProduct(
        $product_item->getAttribute(PRODUCT_OBJECT_ID),
        $product_item->find(PRODUCT_SKU)[0]->text(),
        $product_item->find(PRODUCT_TITLE)[0]->text(),
        $product_item->find(PRODUCT_IMG_WRAPPER)[0]->find('a')[0]->href,
        $product_item->find(PRODUCT_IMG_WRAPPER)[0]->find('img')[0]->src,
        $key
    );

    $scraped_products_collection[] = $scrpr;

    unset($scrpr);
}

/**
 * Print (Serialize) Crawled Products
 */
echo "<pre>";
print_r($scraped_products_collection);
echo "</pre>";

unset($product_items);
unset($html);

