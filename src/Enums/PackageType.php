<?php

namespace Panacea\Stamps\Enums;

enum PackageType: string
{
    case LARGE_ENVELOPE_OR_FLAT = 'Large Envelope or Flat';
    case THICK_ENVELOPE = 'Thick Envelope';
    case PACKAGE = 'Package';
    case FLAT_RATE_BOX = 'Flat Rate Box';
    case SMALL_FLAT_RATE_BOX = 'Small Flat Rate Box';
    case LARGE_FLAT_RATE_BOX = 'Large Flat Rate Box';
    case FLAT_RATE_ENVELOPE = 'Flat Rate Envelope';
    case LARGE_PACKAGE = 'Large Package';
    case OVERSIZE_PACKAGE = 'Oversize Package';
}