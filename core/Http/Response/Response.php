<?php
namespace Core\Http\Response;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response extends SymfonyResponse{

    /**
     * @throws \Exception
     */
    public function __construct(mixed $content = '', int $status = 200, array $headers = [])
    {
        parent::__construct('', $status, $headers);
        $this->setContent($content);
    }

    /**
     * Set the content on the response.
     *
     * @param  mixed  $content
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    #[\Override]
    public function setContent(mixed $content): static
    {
        if (is_array($content)) {
            $this->headers->set('Content-Type', 'application/json');
            $content = json_encode($content);

            if ($content === false) {
                throw new \InvalidArgumentException(json_last_error_msg());
            }
        }

        parent::setContent($content);
        return $this;
    }
}