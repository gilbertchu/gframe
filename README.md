# Gilbert's Mini PHP Framework

A lightweight framework, which follows the MVC style. Still in very early stages. Built with PHP (can deploy with php-fpm and nginx)

Use nginx and point your php-fpm proxy script to index.php or api.php. The optional api endpoint is configured to handle json requests and responses. You will want to serve static files separately from php, either through a cloud storage service (Amazon S3), or by serving them directly from nginx from your server (you can use the try_files directive).

Like I said before - It's still very incomplete!
