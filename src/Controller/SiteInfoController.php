<?php
namespace Drupal\site_info\Controller;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Access\AccessResult;

/**
 * Defines the SiteInfo controller.
 */
class SiteInfoController {
 
  /**
   * Checks access for this controller.
   */
  public function access($siteapikey, NodeInterface $node) {
      
    //Node whether exist or not is handled by the routing file
    //Allow only if the site api key matches
    if ($siteapikey == \Drupal::config('system.site')->get('siteapikey')) {
        
      //Allow only if bundle type is page
      if ($node->getType() == 'page') {
        return AccessResult::allowed();
      }
    }
    
    // Return 403 Access Denied page.  
    return AccessResult::forbidden();
  }
  
  /**
   * Returns content for this controller.
   */
  public function pageJson($siteapikey, NodeInterface $node) {
    return new JsonResponse($node->toArray());
  }
}
