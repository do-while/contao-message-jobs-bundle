<?php

/**
 * Extension for Contao 4
 *
 * @copyright  Softleister 2018
 * @author     Softleister <info@softleister.de>
 * @package    contao-message-jobs-bundle
 * @licence    LGPL-3.0+
 */

namespace Softleister\MessagejobsBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;


/**
 * Plugin for the Contao Manager.
 *
 * @author Softleister
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles( ParserInterface $parser )
    {
        return [
            BundleConfig::create( 'Softleister\MessagejobsBundle\SoftleisterMessagejobsBundle' )
                ->setLoadAfter( ['Contao\CoreBundle\ContaoCoreBundle'] ),
        ];
    }
}
