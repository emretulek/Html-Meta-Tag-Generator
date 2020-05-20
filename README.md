# Html-Meta-Tag-Generator
Generate html and meta tags with php classes

### Wiki

[Meta Tags](https://github.com/emretulek/Html-Meta-Tag-Generator/wiki/Meta-Tags)
```
Meta::title(string $text = null)
Meta::link(string $href, string $rel, $type = null)
Meta::script(string $src = null, string $script = null, string $type = null)
Meta::setName(string $name, string $content, string $property = null)
Meta::addName(string $name, string $content, string $property = null)
Meta::setProperty(string $property, string $content, string $name = null)
Meta::addProperty(string $property, string $content, string $name = null)
Meta::setEquiv(string $value, string $content)
Meta::addEquiv(string $value, string $content)
Meta::getLinks(string $rel = null)
Meta::getScripts()
Meta::getNames(string $name)
Meta::getProperties(string $property = null)
Meta::getEquivs(string $value = null)
Meta::getAll()
Meta::getAllTags()
```

[Html Tags](https://github.com/emretulek/Html-Meta-Tag-Generator/wiki/Html-Tags)
```
Html::tag(string $tagName, string $text = null)
Html::form(string $action = null, string $method = "post", bool $multipart = false)
Html::input(string $type, string $name, string $value = null)
Html::file(string $name, $multiple = false)
Html::select(string $name, array $options, string $selectedOption = null, $multiple = false)
Html::checkbox(string $name, string $value = null, $checked = false)
Html::radio(string $name, string $value = null, $checked = false)
Html::textarea(string $name, string $text = null)
Html::button(string $text)
Html::a(string $href, string $text, string $target = null)
Html::img(string $src, string $alt = "")
Html::picture(string $src, string $alt, array $datasets = [])
Html::elements(array $elements)
```

[Tag Class](https://github.com/emretulek/Html-Meta-Tag-Generator/wiki/Tag-Class)
```
Tag::text(string $text = null)
Tag::html(string $html = null)
Tag::val(string $value = null)`
Tag::attr($attributes, string $value = null)
Tag::addClass(string $className)
Tag::removeClass(string $className)
Tag::removeAttr($attributes)
Tag::append(string $html)
Tag::prepend(string $html)
Tag::remove()
```

### License

MIT License [lisans hakkında](https://github.com/emretulek/Html-Meta-Tag-Generator/blob/master/LICENSE)
