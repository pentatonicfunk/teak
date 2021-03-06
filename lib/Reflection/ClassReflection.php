<?php

namespace Teak\Reflection;

/**
 * Class ClassReflection
 */
class ClassReflection extends Reflection
{
    /**
     * ClassReflection constructor.
     *
     * @param \phpDocumentor\Reflection\Php\Class_ $reflection
     */
    public function __construct($reflection)
    {
        parent::__construct($reflection);
    }

    public function hasMethods()
    {
        if (method_exists($this, 'getMethods')) {
            return !empty($this->getMethods());
        }

        return false;
    }

    public function getMethods()
    {
        $methods = $this->reflection->getMethods();
        $methods = array_filter($methods, function ($item) {
            return ! (new Reflection($item))->shouldIgnore();
        });

        return $methods;
    }

    public function getProperties()
    {
        $properties = $this->reflection->getProperties();
        $properties = array_filter($properties, function ($item) {
            return ! (new Reflection($item))->shouldIgnore();
        });

        return $properties;
    }

    public function getParent()
    {
        return $this->reflection->getParent();
    }

    public function getInterfaces()
    {
        return $this->reflection->getInterfaces();
    }
}
