# 創想知識後臺列印模板
## 環境需求
1. Laravel > 9.0
1. PHP > 8.1

## 環境配置
1. `vi composer.json`
2. `add`
    ```json
        "repositories": {
            "cpkm/print": {
                "type": "vcs",
                "url": "git@github.com:cpkm-service/print.git"
            }
        }
    ```
3. `composer require cpkm-service/print`
4. `php artisan migrate`
5. `php artisan vendor:publish --tag="print-public"`
