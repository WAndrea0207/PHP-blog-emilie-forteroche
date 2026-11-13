<?php
/**
 * Page de monitoring : liste des articles avec le titre, le nombre de vues,
 * le nombre de commentaires et la date de publication.
 * Les colonnes peuvent être triées (croissant / décroissant) en cliquant sur leur en-tête.
 */

/**
 * Construit le lien d'en-tête d'une colonne triable.
 * Cliquer sur la colonne déjà triée inverse l'ordre ; sinon on trie en croissant.
 */
function monitoringSortLink(string $column, string $label, string $currentSort, string $currentOrder) : string
{
    $newOrder = ($currentSort === $column && $currentOrder === 'ASC') ? 'DESC' : 'ASC';
    $arrow = '';
    if ($currentSort === $column) {
        $arrow = $currentOrder === 'ASC' ? ' ▲' : ' ▼';
    }
    return '<a href="index.php?action=monitoring&sort=' . $column . '&order=' . $newOrder . '">' . $label . $arrow . '</a>';
}
?>

<h2>Monitoring du blog</h2>

<table class="monitoringTable">
    <thead>
        <tr>
            <th><?= monitoringSortLink('title', 'Titre', $sortBy, $order) ?></th>
            <th><?= monitoringSortLink('views', 'Vues', $sortBy, $order) ?></th>
            <th><?= monitoringSortLink('comments', 'Commentaires', $sortBy, $order) ?></th>
            <th><?= monitoringSortLink('date', 'Date de publication', $sortBy, $order) ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $index => $article) { ?>
            <tr class="<?= $index % 2 === 0 ? 'oddRow' : 'evenRow' ?>">
                <td><?= htmlspecialchars($article->getTitle()) ?></td>
                <td><?= $article->getNbViews() ?></td>
                <td><?= $article->getNbComments() ?></td>
                <td><?= $article->getDateCreation()->format('d/m/Y H:i') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
