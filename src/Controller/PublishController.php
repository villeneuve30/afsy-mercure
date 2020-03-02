<?php


namespace App\Controller;

//./mercure --jwt-key "I-c4N_H@Z{M3rCuR3}&SymF0nY~1n~AFSY" --addr "localhost:3000" --cors-allowed-origins "http://127.0.0.1:8000" --publish-allowed-origins "*"
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class PublishController extends AbstractController
{
    /**
     * @route("/message", name="sendMessage", methods={"POST"})
     *
     * @param MessageBusInterface $bus
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(MessageBusInterface $bus, Request $request): RedirectResponse
    {
        $update = new Update('http://chat.afsy.fr/message', json_encode([
            'user' => $request->request->get('user'),
            'message' => $request->request->get('message')
        ]));

        $bus->dispatch($update);
        return $this->redirectToRoute('home');
    }
}
