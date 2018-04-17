# Extra menu

:heavy_plus_sign: Bonus menu component

## Introduction

This package contains component designed for generating static menu in admininstration layout.

## Dependencies

- [nepttune/base-requirements](https://github.com/nepttune/base-requirements)
- [nepttune/base-component](https://github.com/nepttune/base-component)

## How to use

- Register `\Nepttune\Component\IConfigMenuFactory` as service in cofiguration file, inject it into presenter, write `createComponent` method and use macro `{control}` in template file.
  - Just as any other component.
  - You need to pass array configuration to factory service.
- Modify parameters to accomplish your needs.

Parameter array has to follow format of following example. There is some clarifying description.

- `Menu` and `Menu2` are non clickable items. Can be used as headers or for multiple menu sections.
- `order` and `settings` are representation of menu items with following options.
  - `dest` - Link destination. Can be array, to create expandable sub-menu.
  - `icon` - Displayed FA icon.
  - `name` - Displayed name.
  - `role` - Role required for user to have in order to display this link. (OPTIONAL)
  - `class` - HTML class added to the link element. When `dest` is an array, class is added to every link. (OPTIONAL)
- `category` and `ingredient` are representation of submenu options with following options.
  - `dest` - Link destination.
  - `name` - Displayed name.
  - `role` - Role required for user to have in order to display this link. (OPTIONAL)
  - `class` - HTML class added to the link element. (OPTIONAL)

### Example configuration

```
services:
    configNavbar:
        implement: Nepttune\Component\IConfigMenuFactory
        arguments:
          - '%configMenu%'
parameters:
    configMenu:
        Menu:
            order:
                name: 'Order'
                icon: 'comments'
                dest: 'Order:default'
                role: 'administrator'
        Menu2:
            settings:
                name: 'Settings'
                icon: 'cog'
                dest:
                    category:
                        name: 'Category'
                        dest: 'Category:default'
                    ingredient:
                        name: 'Ingredient'
                dest: 'Ingredient:default'
```
Which renders as following HTML.
```
<ul class="sidebar-menu" data-widget="tree"> 
  <li class="header">Menu</li> 
  <li>
    <a href="/order/">
      <i class="fa fa-comments"></i> 
      <span>Order</span>
    </a> 
  </li> 
  <li class="header">Menu2</li> 
  <li class="treeview">
    <a href="#">
      <i class="fa fa-cog"></i> 
      <span>Settings</span> 
      <span class="pull-right-container"> 
        <i class="fa fa-angle-left pull-right"></i> 
      </span> 
    </a> 
    <ul class="treeview-menu"> 
      <li>
        <a href="/category/">Category</a>
      </li>
      <li>
        <a href="/ingredient/">Ingredient</a>
      </li> 
    </ul> 
  </li> 
</ul>
```
