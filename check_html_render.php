<?php
$html = file_get_contents('http://127.0.0.1:8000/');
if (!$html) {
    echo "Failed to fetch homepage\n";
    exit(1);
}

// Check if Slim Fit Jeans is in HTML
if (strpos($html, 'Slim Fit Jeans') !== false) {
    echo "✓ 'Slim Fit Jeans' found in HTML\n";
} else {
    echo "✗ 'Slim Fit Jeans' NOT found in HTML\n";
}

// Check if quan-1.png is in HTML
if (strpos($html, 'quan-1.png') !== false) {
    echo "✓ 'quan-1.png' found in HTML\n";
} else {
    echo "✗ 'quan-1.png' NOT found in HTML\n";
}

// Check if product-card component is in HTML
if (strpos($html, 'product-card') !== false || strpos($html, 'object-cover') !== false) {
    echo "✓ Product cards found in HTML\n";
} else {
    echo "✗ Product cards NOT found in HTML\n";
}

// Show a snippet if Slim Fit found
if (strpos($html, 'Slim Fit Jeans') !== false) {
    $start = strpos($html, 'Slim Fit Jeans') - 300;
    $snippet = substr($html, max(0, $start), 600);
    echo "\nSnippet around 'Slim Fit Jeans':\n";
    echo "...\n" . htmlspecialchars($snippet) . "\n...\n";
}
?>
