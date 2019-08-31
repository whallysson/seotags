<?php

namespace CodeBlog\Seotags;

/**
 * Class CodeBlog Seotags
 *
 * @author Whallysson Avelino <https://github.com/whallysson>
 * @package CodeBlog\Seotags
 */
class Seotags extends MetaTags {
    /**
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $image
     * @param bool $follow
     * @return Seotags
     */
    public function seotags(
        string $title,
        string $description,
        string $url,
        string $image,
        bool $follow = true
    ): Seotags {
        $this->data($title, $description, $url, $image);
        $title = $this->filter($title);
        $description = $this->filter($description);

        $this->buildTag("title", $title);
        $this->buildMeta("name", ["description" => $description]);
        $this->buildMeta("name", ["robots" => ($follow ? "index, follow" : "noindex, nofollow")]);
        $this->buildLink("canonical", $url);

        foreach ($this->tags as $meta => $prefix) {
            $this->buildMeta($meta, [
                "{$prefix}:title" => $title,
                "{$prefix}:description" => $description,
                "{$prefix}:url" => $url,
                "{$prefix}:image" => $image,
            ]);
        }

        $this->buildMeta("itemprop", [
            "name" => $title,
            "description" => $description,
            "url" => $url,
            "image" => $image,
        ]);

        return $this;
    }

    /**
     * @param string $facebook_page
     * @param string|null $facebook_author
     * @return Seotags
     */
    public function publisher(
        string $facebook_page,
        string $facebook_author = null
    ): Seotags {
        $this->buildMeta("property", [
            "article:publisher" => "https://www.facebook.com/{$facebook_page}",
        ]);

        if ($facebook_author) {
            $this->buildMeta("property", [
                "article:author" => "https://www.facebook.com/{$facebook_author}"
            ]);
        }

        return $this;
    }

    /**
     * @param string $siteName
     * @param string $locale
     * @param string $schema
     * @return Seotags
     */
    public function openGraph(
        string $siteName,
        string $locale = "pt_BR",
        string $schema = "article"
    ): Seotags {
        $prefix = "og";
        $siteName = $this->filter($siteName);

        $this->buildMeta("property", [
            "{$prefix}:type" => $schema,
            "{$prefix}:site_name" => $siteName,
            "{$prefix}:locale" => $locale,
        ]);

        if (isset($this->data->title)) {
            $og = $this->meta->addChild("meta");
            $og->addAttribute("property", "{$prefix}:title");
            $og->addAttribute("content", $this->data->title);
        }

        if (isset($this->data->description)) {
            $og = $this->meta->addChild("meta");
            $og->addAttribute("property", "{$prefix}:description");
            $og->addAttribute("content", $this->data->description);
        }

        if (isset($this->data->url)) {
            $og = $this->meta->addChild("meta");
            $og->addAttribute("property", "{$prefix}:url");
            $og->addAttribute("content", $this->data->url);
        }

        if (isset($this->data->image)) {
            $this->buildMeta("property", [
                "{$prefix}:image" => $this->data->image,
                "{$prefix}:secure_url" => $this->data->image,
            ]);


            if ($this->fileExists($this->data->image)) {
                $OgImage = getimagesize($this->data->image);

                if ($OgImage['mime']) {
                    $og = $this->meta->addChild("meta");
                    $og->addAttribute("property", "{$prefix}:image:type");
                    $og->addAttribute("content", $OgImage['mime']);
                }
                if ($OgImage[0]) {
                    $og = $this->meta->addChild("meta");
                    $og->addAttribute("property", "{$prefix}:image:width");
                    $og->addAttribute("content", $OgImage[0]);
                }
                if ($OgImage[1]) {
                    $og = $this->meta->addChild("meta");
                    $og->addAttribute("property", "{$prefix}:image:height");
                    $og->addAttribute("content", $OgImage[1]);
                }
            }
        }

        return $this;
    }

    /**
     * @param string $creator
     * @param string $site
     * @param string $domain
     * @param string|null $card
     * @return Seotags
     */
    public function twitterCard(
        string $creator,
        string $site,
        string $domain,
        string $card = null
    ): Seotags {
        $prefix = "twitter";

        $this->buildMeta("name", [
            "{$prefix}:creator" => $creator,
            "{$prefix}:site" => $site,
            "{$prefix}:domain" => $domain,
            "{$prefix}:card" => ($card ?? "summary_large_image")
        ]);

        return $this;
    }


    /**
     * @param string|null $appId
     * @param string|null $pages
     * @param array|null $admins
     * @return Seotags
     */
    public function facebook(string $appId = null, string $pages = null, array $admins = null): Seotags {
        if ($pages) {
            $fb = $this->meta->addChild("meta");
            $fb->addAttribute("property", "fb:pages");
            $fb->addAttribute("content", $pages);
        }
        
        if ($appId) {
            $fb = $this->meta->addChild("meta");
            $fb->addAttribute("property", "fb:app_id");
            $fb->addAttribute("content", $appId);
            return $this;
        }        

        if ($admins) {
            foreach ($admins as $admin) {
                $fb = $this->meta->addChild("meta");
                $fb->addAttribute("property", "fb:admins");
                $fb->addAttribute("content", $admin);
            }
        }

        return $this;
    }

    /**
     * @param string $hexacolor
     * @return Seotags
     */
    public function themecolor(string $hexacolor): Seotags {
        $color = $this->meta->addChild("meta");
        $color->addAttribute("name", "theme-color");
        $color->addAttribute("content", $hexacolor);

        return $this;
    }


    /**
     * @param $url
     * @return bool
     */
    public function fileExists($url): bool {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($code == 200); // verifica se recebe "status OK"
    }
}
