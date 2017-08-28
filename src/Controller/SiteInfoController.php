<?php
namespace Drupal\site_info\Controller;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class SiteInfoController {
  public function pageJson($siteapikey, NodeInterface $node) {
    //Node whether exist or not is handled by the routing file
    //Allow only if the site api key matches
    if ($siteapikey == \Drupal::config('system.site')->get('siteapikey')) {
      //Allow only if bundle type is page
      if ($node->getType() == 'page') {
        return new JsonResponse($node->toArray());
      }
    }
    //Access denied if any of the condition becomes false.
    return new JsonResponse("access denied");
  }
}