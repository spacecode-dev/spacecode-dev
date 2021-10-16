<?php

namespace SpaceCode\GoDesk;

class Robots {

    /**
     * The lines of for the robots.txt
     * @var array
     */
    protected $lines = [];

    /**
     * Generate the robots.txt data.
     * @return string
     */
    public function generate(): string
    {
        return implode(PHP_EOL, $this->lines);
    }

    /**
     * Add a Sitemap to the robots.txt.
     * @param string $sitemap
     */
    public function addSitemap(string $sitemap)
    {
        $this->addLine("Sitemap: $sitemap");
    }

    /**
     * Add a User-agent to the robots.txt.
     * @param string $userAgent
     */
    public function addUserAgent(string $userAgent)
    {
        $this->addLine("User-agent: $userAgent");
    }

    /**
     * Add a Host to the robots.txt.
     * @param string $host
     */
    public function addHost(string $host)
    {
        $this->addLine("Host: $host");
    }

    /**
     * Add a disallow rule to the robots.txt.
     * @param string|array $directories
     */
    public function addDisallow($directories)
    {
        $this->addRuleLine($directories, 'Disallow');
    }

    /**
     * Add a allow rule to the robots.txt.
     * @param string|array $directories
     */
    public function addAllow($directories)
    {
        $this->addRuleLine($directories, 'Allow');
    }

    /**
     * Add a rule to the robots.txt.
     * @param string|array $directories
     * @param string $rule
     */
    protected function addRuleLine($directories, string $rule)
    {
        foreach ((array)$directories as $directory)
        {
            $this->addLine("$rule: $directory");
        }
    }

    /**
     * Add a comment to the robots.txt.
     * @param string $comment
     */
    public function addComment(string $comment)
    {
        $this->addLine("# $comment");
    }

    /**
     * Add a spacer to the robots.txt.
     */
    public function addSpacer()
    {
        $this->addLine("");
    }

    /**
     * Add a line to the robots.txt.
     * @param string $line
     */
    protected function addLine(string $line)
    {
        $this->lines[] = (string) $line;
    }

    /**
     * Add multiple lines to the robots.txt.
     * @param string|array $lines
     */
    protected function addLines($lines)
    {
        foreach ((array) $lines as $line)
        {
            $this->addLine($line);
        }
    }

    /**
     * Reset the lines.
     * @return void
     */
    public function reset()
    {
        $this->lines = [];
    }
}