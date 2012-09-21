<?php
namespace TYPO3\Surf\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "TYPO3.Surf".                 *
 *                                                                        *
 *                                                                        */

use TYPO3\Surf\Exception\InvalidConfigurationException;

/**
 * A generic application without any tasks
 *
 */
class Application {

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * The nodes for this application
	 * @var array
	 */
	protected $nodes = array();

	/**
	 * The deployment path for this application on a node
	 * @var string
	 */
	protected $deploymentPath;

	/**
	 * The options
	 * @var array
	 */
	protected $options = array();

	/**
	 * Constructor
	 *
	 * @param string $name
	 */
	public function __construct($name) {
		$this->name = $name;
	}

	/**
	 * Register tasks for this application
	 *
	 * This is a template method that should be overriden by specific applications.
	 *
	 * @param \TYPO3\Surf\Domain\Model\Workflow $workflow
	 * @param \TYPO3\Surf\Domain\Model\Deployment $deployment
	 * @return void
	 */
	public function registerTasks(Workflow $workflow, Deployment $deployment) {}

	/**
	 * Get the name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return \TYPO3\Surf\Domain\Model\Application
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * Get the Deployment's nodes
	 *
	 * @return array The Deployment's nodes
	 */
	public function getNodes() {
		return $this->nodes;
	}

	/**
	 * Sets this Deployment's nodes
	 *
	 * @param array $nodes The Deployment's nodes
	 * @return \TYPO3\Surf\Domain\Model\Application
	 */
	public function setNodes(array $nodes) {
		$this->nodes = $nodes;
		return $this;
	}

	/**
	 * Add a node
	 *
	 * @param \TYPO3\Surf\Domain\Model\Node $node
	 * @return \TYPO3\Surf\Domain\Model\Application
	 */
	public function addNode(Node $node) {
		$this->nodes[$node->getName()] = $node;
		return $this;
	}

	/**
	 * Return TRUE if the given node is registered for this application
	 *
	 * @param Node $node
	 * @return boolean
	 */
	public function hasNode(Node $node) {
		return isset($this->nodes[$node->getName()]);
	}

	/**
	 * @return string
	 * @throws \TYPO3\Surf\Exception\InvalidConfigurationException
	 */
	public function getDeploymentPath() {
		if ($this->deploymentPath === NULL) {
			throw new InvalidConfigurationException(sprintf('No deployment path has been defined for application %s.', $this->name), 1312220645);
		}
		return $this->deploymentPath;
	}

	/**
	 *
	 * @return string
	 */
	public function getSharedPath() {
		return $this->getDeploymentPath() . '/shared';
	}

	/**
	 *
	 * @param string $deploymentPath
	 * @return \TYPO3\Surf\Domain\Model\Application
	 */
	public function setDeploymentPath($deploymentPath) {
		$this->deploymentPath = rtrim($deploymentPath, '/');
		return $this;
	}

	/**
	 *
	 * @return array
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 *
	 * @param string $key
	 * @return mixed
	 */
	public function getOption($key) {
		return $this->options[$key];
	}

	/**
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function hasOption($key) {
		return isset($this->options[$key]);
	}

	/**
	 *
	 * @param array $options
	 * @return \TYPO3\Surf\Domain\Model\Application
	 */
	public function setOptions($options) {
		$this->options = $options;
		return $this;
	}

	/**
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return \TYPO3\Surf\Domain\Model\Application
	 */
	public function setOption($key, $value) {
		$this->options[$key] = $value;
		return $this;
	}

}
?>