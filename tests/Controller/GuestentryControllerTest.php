<?php

namespace App\Test\Controller;

use App\Entity\Guestentry;
use App\Repository\GuestentryRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GuestentryControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private GuestentryRepository $repository;
    private string $path = '/guestentry/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Guestentry::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Guestentry index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'guestentry[title]' => 'Testing',
            'guestentry[image]' => 'Testing',
            'guestentry[created_on]' => 'Testing',
            'guestentry[status]' => 'Testing',
            'guestentry[modified_on]' => 'Testing',
            'guestentry[user]' => 'Testing',
            'guestentry[modified]' => 'Testing',
        ]);

        self::assertResponseRedirects('/guestentry/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Guestentry();
        $fixture->setTitle('My Title');
        $fixture->setImage('My Title');
        $fixture->setCreated_on('My Title');
        $fixture->setStatus('My Title');
        $fixture->setModified_on('My Title');
        $fixture->setUser('My Title');
        $fixture->setModified('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Guestentry');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Guestentry();
        $fixture->setTitle('My Title');
        $fixture->setImage('My Title');
        $fixture->setCreated_on('My Title');
        $fixture->setStatus('My Title');
        $fixture->setModified_on('My Title');
        $fixture->setUser('My Title');
        $fixture->setModified('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'guestentry[title]' => 'Something New',
            'guestentry[image]' => 'Something New',
            'guestentry[created_on]' => 'Something New',
            'guestentry[status]' => 'Something New',
            'guestentry[modified_on]' => 'Something New',
            'guestentry[user]' => 'Something New',
            'guestentry[modified]' => 'Something New',
        ]);

        self::assertResponseRedirects('/guestentry/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getImage());
        self::assertSame('Something New', $fixture[0]->getCreated_on());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getModified_on());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getModified());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Guestentry();
        $fixture->setTitle('My Title');
        $fixture->setImage('My Title');
        $fixture->setCreated_on('My Title');
        $fixture->setStatus('My Title');
        $fixture->setModified_on('My Title');
        $fixture->setUser('My Title');
        $fixture->setModified('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/guestentry/');
    }
}
