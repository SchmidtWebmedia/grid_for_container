# Grid for Container

[![Latest Stable Version](https://poser.pugx.org/schmidtwebmedia/grid-for-container/d/total.svg?style=flat-square)](https://extensions.typo3.org/extension/grid_for_container)
[![TYPO3 11](https://img.shields.io/badge/TYPO3-11-orange.svg?style=flat-square&logo=typo3&labelColor=292929&color=ff8700)](https://get.typo3.org/version/11)
[![TYPO3 12](https://img.shields.io/badge/TYPO3-12-orange.svg?style=flat-square&logo=typo3&labelColor=292929&color=ff8700)](https://get.typo3.org/version/12)
[![TYPO3 12](https://img.shields.io/badge/TYPO3-13-orange.svg?style=flat-square&logo=typo3&labelColor=292929&color=ff8700)](https://get.typo3.org/version/13)
[![Container](https://img.shields.io/badge/Container-^3-green)](https://extensions.typo3.org/extension/container)

[![Total Downloads](https://poser.pugx.org/schmidtwebmedia/grid-for-container/d/total.svg?style=flat-square)](https://packagist.org/packages/schmidtwebmedia/grid-for-container)
[![Monthly Downloads](https://poser.pugx.org/schmidtwebmedia/grid-for-container/d/monthly?style=flat-square)](https://packagist.org/packages/schmidtwebmedia/grid-for-container)

## Description

You can use this extension for adding an easy to use Grid which are Framework independently.

It's pre-configured for Bootstrap 3, 4 and 5.

***Important: The Bootstrap CSS/JS is not included***

## Features

There are Grid options to choose for an TYPO3 editor. Something like (e.g. two column)
* 50/50
* 33/66
* 25/75

This work for
* 1 column grid
* 2 column grid
* 3 column grid
* 4 column grid

### Backend

#### Backend View

![Screenshot Backend](https://abload.de/img/backendlfkat.png)

### Frontend
![Screenshot Frontend Output](https://abload.de/img/frontendo3jif.png)

## Install

1) Install the extension container.
2) Install the extension grid_for_container
3) Include the static template
4) Be happy with an easy way to use Grids in TYPO3 :)

### Composer install:
```bash
composer require schmidtwebmedia/grid-for-container
```

## Customizing

You can customize the output in frontend and change the framework or add more options for Grid ratio.
And change the path to JSON Config file in extension settings.

Please use following structure of json file:


```json
{
  "cols": [
    {
      "onecol": [
        {
          "label": "",
          "class": [
            "",
            ""
          ]
        }
      ],
      "twocol": [
        {
          "label": "",
          "class": [
            "",
            ""
          ]
        }
      ],
      "threecol": [
        {
          "label": "",
          "class": [
            "",
            "",
            ""
          ]
        }
      ],
      "fourthcol": [
        {
          "label": "",
          "class": [
            "",
            "",
            "",
            ""
          ]
        }

      ]
    }
  ],
  "row": [
    {
      "class": ""
    }
  ]
}
```
