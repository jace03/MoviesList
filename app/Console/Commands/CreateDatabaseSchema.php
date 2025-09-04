<?php

namespace App\Console\Commands;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Illuminate\Console\Command;

class CreateDatabaseSchema extends Command
{
    protected $signature = 'doctrine:schema:create';
    protected $description = 'Create database schema from Doctrine entities';

    public function handle(EntityManagerInterface $entityManager)
    {
        $schemaTool = new SchemaTool($entityManager);
        $classes = $entityManager->getMetadataFactory()->getAllMetadata();

        try {
            $schemaTool->createSchema($classes);
            $this->info('Schema created successfully!');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
