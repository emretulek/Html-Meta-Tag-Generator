<?php 
/**
 * @Created 14.05.2020 06:53:27
 * @Project simpleFramework
 * @Author Mehmet Emre Tülek <memretulek@gmail.com>
 * @Class Meta
 * @package Html
 */


namespace HTML;


class Meta {

    private static $metaTags = [];
    private static $selected = 0;


    /**
     * Değer girilirse title değiştirilir, boş bırakılırsa title değerini döndürür
     * Değer değiştirmek yerine ekleme yaplılmak istenirse appen ve prepen kullanılabilir
     * @param string $text
     * @return Tag
     */
    public static function title(string $text = null)
    {
        if($text){
            $tag = new Tag('title');
            $tag->text($text);
            self::$metaTags['title'][0] = $tag;
        }

        return self::$metaTags['title'][0] ?? null;
    }


    /**
     * Yeni bir link tagi oluşturur, rel değeri anahtar olarak atanır
     * @param string $href
     * @param string $rel
     * @param null $type
     * @return Tag
     */
    public static function link(string $href, string $rel, $type = null)
    {
        $tag = new Tag('link', false);
        $tag->attr('href', $href)
            ->attr('rel', $rel);

        if($type){
            $tag->attr('type', $type);
        }

        isset(self::$metaTags[$rel]) ? self::$selected++ : self::$selected;

        return self::$metaTags[$rel][self::$selected] = $tag;
    }


    /**
     * Yeni bir script tagi oluşturur, link gibi anahtar değer içermez
     * script tagleri sadece toplu olarak çağırılabilir
     * @param string|null $src
     * @param string|null $script
     * @param string|null $type
     * @return Tag
     */
    public static function script(string $src = null, string $script = null, string $type = null)
    {
        $tag = new Tag('script');

        if($src){
            $tag->attr('src', $src);
        }
        if($script){
            $tag->html($script);
        }
        if($type){
            $tag->attr('type', $type);
        }

        isset(self::$metaTags['_script']) ? self::$selected++ : self::$selected;

        return self::$metaTags['_script'][self::$selected] = $tag;
    }

    /**
     * adı girilen meta etiketini oluşturur
     * daha önce oluşturulmuşsa üzerine yazar, eski meta tagi silinir
     * @param string $name
     * @param string $content
     * @param string $property og:description şeklinde belirtilirse meta tag için property özelliği eklenir
     * @return Tag|null
     */
    public static function setName(string $name, string $content, string $property = null)
    {
        $tag = new Tag('meta', false);
        $tag->attr('name', $name)
            ->attr('content', $content);

        if($property){
            $tag->attr('property', $property);
        }

        return self::$metaTags[$name][0] = $tag;
    }


    /**
     * adı girilen meta etiketini oluşturur
     * daha önce oluşturulmuşsa aynı isimde bir etiket daha oluşturulur
     * çoklu meta taglerinde işlevseldir
     * @param string $name
     * @param string $content
     * @param string $property og:description şeklinde belirtilirse meta tag için property özelliği eklenir
     * @return Tag|null
     */
    public static function addName(string $name, string $content, string $property = null)
    {
        $tag = new Tag('meta', false);
        $tag->attr('name', $name)
            ->attr('content', $content);

        if($property){
            $tag->attr('property', $property);
        }

        isset(self::$metaTags[$name]) ? self::$selected++ : self::$selected;
        return self::$metaTags[$name][self::$selected] = $tag;
    }


    /**
     * property adı girilen meta etiketini oluşturur
     * daha önce oluşturulmuşsa üzerine yazar, eski meta tagi silinir
     * @param string $property
     * @param string $content
     * @param string|null $name
     * @return Tag
     */
    public static function setProperty(string $property, string $content, string $name = null)
    {
        $tag = new Tag('meta', false);
        $tag->attr('property', $property)
            ->attr('content', $content);

        if($name){
            $tag->attr('name', $name);
        }

        return self::$metaTags[$property][0] = $tag;
    }


    /**
     * property adı girilen meta etiketini oluşturur
     * daha önce oluşturulmuşsa aynı isimde bir etiket daha oluşturulur
     * çoklu meta taglerinde işlevseldir
     * @param string $property
     * @param string $content
     * @param string|null $name
     * @return Tag
     */
    public static function addProperty(string $property, string $content, string $name = null)
    {
        $tag = new Tag('meta', false);
        $tag->attr('property', $property)
            ->attr('content', $content);

        if($name){
            $tag->attr('name', $name);
        }

        isset(self::$metaTags[$property]) ? self::$selected++ : self::$selected;
        return self::$metaTags[$property][++self::$selected] = $tag;
    }



    /**
     * http-equiv değeri girilen meta etiketini oluşturur
     * daha önce oluşturulmuşsa üzerine yazar, eski meta tagi silinir
     * @param string $value
     * @param string $content
     * @return Tag
     */
    public static function setEquiv(string $value, string $content)
    {
        $tag = new Tag('meta', false);
        $tag->attr('http-equiv', $value)
            ->attr('content', $content);

        return self::$metaTags[$value][0] = $tag;
    }


    /**
     * http-equiv değeri girilen meta etiketini oluşturur
     * daha önce oluşturulmuşsa aynı değerde bir etiket daha oluşturulur
     * çoklu meta taglerinde işlevseldir
     * @param string $value
     * @param string $content
     * @return Tag
     */
    public static function addEquiv(string $value, string $content)
    {
        $tag = new Tag('meta', false);
        $tag->attr('http-equiv', $value)
            ->attr('content', $content);

        isset(self::$metaTags[$value]) ? self::$selected++ : self::$selected;
        return self::$metaTags[$value][++self::$selected] = $tag;
    }


    /**
     * girilen rel değerindeki link tagi, girilmezse tüm linkleri döndürür
     * birden fazla tag dönerse string olarak dönüştürülür
     * @param string $rel Meta::link methodundaki rel değeri
     * @return Tag|string
     */
    public static function getLinks(string $rel = null)
    {
        $metaTags = [];

        if($rel && isset(self::$metaTags[$rel])){

            foreach (self::$metaTags[$rel] as $metaTag){

                if($metaTag->attr('rel') == $rel){

                    $metaTags[] = $metaTag;
                }
            }
        }else{

            foreach (self::$metaTags as $metaTagGroup){

                foreach ($metaTagGroup as $metaTag) {

                    if ($metaTag->attr('rel') !== null) {

                        $metaTags[] = $metaTag;
                    }
                }
            }
        }

        return count($metaTags) === 1 ? $metaTags[0] : implode(PHP_EOL, $metaTags);
    }



    /**
     * Tüm script taglerini döndürür
     * @return Tag|string
     */
    public static function getScripts()
    {
        $metaTags = [];

        foreach (self::$metaTags['_script'] as $metaTag){

            $metaTags[] = $metaTag;
        }

        return count($metaTags) === 1 ? $metaTags[0] : implode(PHP_EOL, $metaTags);
    }


    /**
     * girilen name değerindeki meta tagi, girilmezse tüm propertyleri döndürür
     * birden fazla tag dönerse string olarak dönüştürülür
     * @param string $name Meta:setName veya Meta::addName methodundaki $name değeri
     * @return mixed|null
     */
    public static function getNames(string $name)
    {
        $metaTags = [];

        if($name && isset(self::$metaTags[$name])){

            foreach (self::$metaTags[$name] as $metaTag){

                if($metaTag->attr('name') == $name){

                    $metaTags[] = $metaTag;
                }
            }
        }else{

            foreach (self::$metaTags as $metaTagGroup){

                foreach ($metaTagGroup as $metaTag) {

                    if ($metaTag->attr('name') !== null) {

                        $metaTags[] = $metaTag;
                    }
                }
            }
        }

        return count($metaTags) === 1 ? $metaTags[0] : implode(PHP_EOL, $metaTags);
    }


    /**
     * girilen property değerindeki meta tagi, girilmezse tüm propertyleri döndürür,
     * birden fazla tag dönerse string olarak dönüştürülür
     * @param string $property Meta:setProperty veya Meta::addProperty methodundaki $property değeri
     * @return string|null
     */
    public static function getProperties(string $property = null)
    {
        $metaTags = [];

        if($property && isset(self::$metaTags[$property])){

            foreach (self::$metaTags[$property] as $metaTag){

                if($metaTag->attr('property') == $property){

                    $metaTags[] = $metaTag;
                }
            }
        }else{

            foreach (self::$metaTags as $metaTagGroup){

                foreach ($metaTagGroup as $metaTag) {

                    if ($metaTag->attr('property') !== null) {

                        $metaTags[] = $metaTag;
                    }
                }
            }
        }

        return count($metaTags) === 1 ? $metaTags[0] : implode(PHP_EOL, $metaTags);
    }



    /**
     * girilen value değerindeki meta tagi, girilmezse tüm http-equiv içeren taglari döndürür,
     * birden fazla tag dönerse string olarak dönüştürülür
     * @param string $value Meta::setequiv veya Meta::addequiv methodundaki $value değeri
     * @return string|null
     */
    public static function getEquivs(string $value = null)
    {
        $metaTags = [];

        if($value && isset(self::$metaTags[$value])){

            foreach (self::$metaTags[$value] as $metaTag){

                if($metaTag->attr('http-equiv') == $value){

                    $metaTags[] = $metaTag;
                }
            }
        }else{

            foreach (self::$metaTags as $metaTagGroup){

                foreach ($metaTagGroup as $metaTag) {

                    if ($metaTag->attr('http-equiv') !== null) {

                        $metaTags[] = $metaTag;
                    }
                }
            }
        }

        return count($metaTags) === 1 ? $metaTags[0] : implode(PHP_EOL, $metaTags);
    }


    /**
     * Tüm meta tagleri string döndürür
     * @return string
     */
    public static function getAll()
    {
        $metaTags = "";

        foreach (self::$metaTags as $metaTagGroup){

            foreach ($metaTagGroup as $metaTag){
                $metaTags .= $metaTag;
            }
        }

        return $metaTags;
    }


    /**
     * Tüm meta taglerini dizi olarak döndürür
     * dizi elemanları Tag sınıfının üyesidir methodlar kullanılabilir
     * @return array
     */
    public static function getAllTags()
    {
        $metaTags = [];

        foreach (self::$metaTags as $metaTagGroup){

            foreach ($metaTagGroup as $metaTag){
                $metaTags[] = $metaTag;
            }
        }

        return $metaTags;
    }
}
