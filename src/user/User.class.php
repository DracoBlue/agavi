<?php

// +---------------------------------------------------------------------------+
// | This file is part of the Agavi package.                                   |
// | Copyright (c) 2003-2006 the Agavi Project.                                |
// | Based on the Mojavi3 MVC Framework, Copyright (c) 2003-2005 Sean Kerr.    |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code. You can also view the    |
// | LICENSE file online at http://www.agavi.org/LICENSE.txt                   |
// |   vi: set noexpandtab:                                                    |
// |   Local Variables:                                                        |
// |   indent-tabs-mode: t                                                     |
// |   End:                                                                    |
// +---------------------------------------------------------------------------+

/**
 * AgaviUser wraps a client session and provides accessor methods for user
 * attributes. It also makes storing and retrieving multiple page form data
 * rather easy by allowing user attributes to be stored in namespaces, which
 * help organize data.
 *
 * @package    agavi
 * @subpackage user
 *
 * @author     Sean Kerr <skerr@mojavi.org>
 * @author     Agavi Project <info@agavi.org>
 * @copyright  (c) Authors
 * @since      0.9.0
 *
 * @version    $Id$
 */
class AgaviUser extends AgaviAttributeHolder
{
	protected
		$context = null,
		$storageNamespace = 'org.agavi.user.User';

	/**
	 * Retrieve the current application context.
	 *
	 * @return     Context A Context instance.
	 *
	 * @author     Sean Kerr <skerr@mojavi.org>
	 * @since      0.9.0
	 */
	public function getContext()
	{
		return $this->context;
	}

	/**
	 * Retrieve the Storage namespace
	 *
	 * @return     string The Storage namespace
	 *
	 * @author     David Zuelke <dz@bitxtender.com>
	 * @since      0.11.0
	 */
	public function getStorageNamespace()
	{
		return $this->storageNamespace;
	}

	/**
	 * Initialize this User.
	 *
	 * @param      AgaviContext A Context instance.
	 * @param      array        An associative array of initialization parameters.
	 *
	 * @return     bool true, if initialization completes successfully,
	 *                  otherwise false.
	 *
	 * @throws     <b>AgaviInitializationException</b> If an error occurs while
	 *                                                 initializing this User.
	 *
	 * @author     Sean Kerr <skerr@mojavi.org>
	 * @author     David Zuelke <dz@bitxtender.com>
	 * @since      0.9.0
	 */
	public function initialize($context, $parameters = null)
	{
		$this->context = $context;

		if(isset($parameters['default_namespace'])) {
			$this->defaultNamespace = $parameters['default_namespace'];
		}
		
		if(isset($parameters['storage_namespace'])) {
			$this->storageNamespace = $parameters['storage_namespace'];
		}

		if($parameters != null)
		{
			$this->parameters = array_merge($this->parameters, $parameters);
		}
		
		// read data from storage
		$this->attributes = $context->getStorage()->read($this->storageNamespace);

		if($this->attributes == null)
		{
			// initialize our attributes array
			$this->attributes = array();
		}
	}

	/**
	 * Retrieve a new User implementation instance.
	 *
	 * @param      string A User implementation name
	 *
	 * @return     AgaviUser A User implementation instance.
	 *
	 * @throws     <b>AgaviFactoryException</b> If a user implementation instance
	 *                                          cannot be created.
	 *
	 * @author     Sean Kerr <skerr@mojavi.org>
	 * @since      0.9.0
	 */
	public static function newInstance($class)
	{
		// the class exists
		$object = new $class();

		if (!($object instanceof AgaviUser))
		{

			// the class name is of the wrong type
			$error = 'Class "%s" is not of the type User';
			$error = sprintf($error, $class);

			throw new AgaviFactoryException($error);

		}

		return $object;
	}

	/**
	 * Execute the shutdown procedure.
	 *
	 * @return     void
	 *
	 * @author     Sean Kerr <skerr@mojavi.org>
	 * @since      0.9.0
	 */
	public function shutdown()
	{
		// write attributes to the storage
		$this->getContext()->getStorage()->write($this->storageNamespace, $this->attributes);
	}
}

?>