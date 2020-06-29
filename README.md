# Simple Dom Crawler


This simple script was actually a job application assignment where the task was to crawl specific web page structure and prepare that data for further usage.

In order to keep things simple pages to be crawled are saved locally inside **test_page** directory.

There are two local pages involved where one is a category products page and the other is a specific product details pages.

The two pages correspond to first product from the categories product list page (**test_page/index.html**) and it's opened details page (**test_page/beakers-griffin-low-form-double-scale-graduated-pyrex/index.html**).

When the script is ran we see two products being crawled from the initial categories product page but since they share the same details url, same details products are being attached to both of them.