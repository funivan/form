<?php

  namespace Fiv\Form\Elements;

  use Fiv\Form\FormData;

  /**
   * Introduce new element interface. This element will be used in future.
   * You can simply create plain html nodes in the form
   *
   * @author Ivan Shcherbak <dev@funivan.com>
   */
  interface ElementInterface {

    /**
     * @param FormData $request
     * @return $this
     */
    public function handle(FormData $request);


    /**
     * @return string
     */
    public function getName();

  }
