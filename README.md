# General Code

## Requirement
- PHP >= 7.2.5
- [Composer](https://getcomposer.org/)

## Installation
`composer require bowmansir/GeneralVue ^1.0`

## Documents

## Usage
```php
<?php
use GeneralVue\GeneralVue;
````

## Advanced Usage
### html.json
```json
{
	"Print to console": {
        "prefix": "vue",
        "body": [
            "<template>",
            "    <div>\n",
            "    </div>",
            "</template>",
            "<script>",
            "export default {",
            "   data() {",
            "      return {",
            "      }",
            "   },",
            "   created(){",
            "   },",
            "   computed:{",
            "   },",
            "   methods:{",
            "   },",
            "}",
            "</script>",
            "<style lang=\"scss\" scoped>\n",
            "</style>",
            "$2"
        ],
        "description": "Log output to console"
    }
}
```
## License
MIT