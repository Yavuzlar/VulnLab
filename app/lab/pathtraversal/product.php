<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        header {
    background-color: #ffffff;
    color: #333; 
    font-family: Arial, sans-serif;
}
.products-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 20px;
        }

        .product {
            width: 300px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .product:hover {
            transform: scale(1.05);
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-details {
            width: 60%;
            margin: 50px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        .navbar-brand{
            margin: 1;
        }

    </style>
    

</head>
<header>
    <h1 id="page-title">En Popüler Hacker Grupları</h1>

</header>

<body>

<div class="product-details">
    <img id="product-image" src="" alt="Ürün Resmi">
    <h2 id="product-name">Ürün Adı</h2>
    <p id="product-description">detaylar</p>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var urlParams = new URLSearchParams(window.location.search);
        var productId = urlParams.get('productId');

        var productData = getProductData(productId);
        document.getElementById('product-image').src = productData.image;
        document.getElementById('product-name').innerText = productData.name;
        document.getElementById('product-description').innerText = productData.description;
    });
    function getProductData(productId) {
        var products = {
            '1': { name: 'Clop Hacker Group', description: 'Clop, which emerged in 2019, targeted large, corporate companies, especially in the finance, healthcare and retail sectors. It gains access to a network by using network vulnerabilities and phishing methods, and then moves horizontally, infecting many systems. It steals data and demands a ransom in return. Some of its victims include users of the German software company Software AG, the University of California San Francisco (UCSF), a leading medical research institution, and the Accellion File Transfer Appliance (FTA). Clop\'s fast and sophisticated tactics continues to pose a serious threat to companies around the world, highlighting the need for strong cybersecurity measures.', image: '/pathtraversal/images/1.png' },
            '2': { name: 'Anonymous', description: 'Anonymous is a good example of a hacktivist collective that believes its work makes the world a better - or at least fairer - place. You may recognize their symbols - Guy Fawkes masks and the slogan "We are Anonymous. We are Legion. We do not forgive. We do not forget. Expect us." They have claimed their work is about advocating for freedom of speech, government transparency, internet freedom, and social justice.The methods of Anonymous involve deploying Distributed Denial of Service (DDoS) attacks to overwhelm websites and make them inaccessible. They have also engaged in data theft and leaked sensitive information from various organizations.They gained notoriety during events like Occupy Wall Street and the Charlie Hebdo attacks. They\'re also the masterminds behind Operation Payback, which targeted PayPal, Visa, and Mastercard after the companies cut off payment services to Wikileaks. Anonymous played a significant role in the  Arab Spring uprisings, creating tools like Tor and VPNs to help protestors organize and share information while disabling and defacing government websites.Authorities have arrested hackers who claim to be part of Anonymous over the years, but the group\'s decentralized nature makes tracking down or prosecuting members challenging. LulzSec, a spin-off group, has been linked to Anonymous due to the similar nature of their attacks, and some of its members were arrested and prosecuted for high-profile attacks, including hacks against Sony and News International.', image: '/pathtraversal/images/Anonymous.jpeg' },
            '3': { name: 'Lazarus Group', description: 'Lazarus Group is a notorious North Korean hacker group known for its destructive cyberattacks. They gained worldwide attention for its 2014 hack of Sony Pictures in retaliation for the movie The Interview.The group is also responsible for the global WannaCry ransomware attack in 2017 that encrypted users\' files, demanding a ransom in Bitcoin for decryption. Lazaruas Group has stolen billions of dollars from banks in Ecuador, Vietnam, Poland, Mexico, and Bangladesh. They use a variety of tactics in their operations but are best known for their spear-phishing campaigns leading to the installation of their own custom malware, such as Destover and Joanap.Silent Chollima, DarkSeoul, and Whois Team are also thought to be North Korean hackers, and some experts believe they might be sub-groups or different names used by Lazarus Group. Their targets have included government agencies, media organizations, defense contractors, and supply chains. ', image: '/pathtraversal/images/LazarusGroup.jpg' },
            '4': { name: 'Carbanak', description: 'Carbanak, also known as Anunak, operates out of Eastern Europe and has targeted banks and other financial institutions worldwide, resulting in the theft of over $1 billion. Later, Carbanak expanded its attacks to target hospitality and retail sectors, compromising point-of-sale (POS) systems and stealing credit card data.This group employs a combination of social engineering, spear-phishing, and malware deployment, such as remote access Trojans (RATs), to execute fraudulent transactions, manipulate account balances, and access sensitive financial data. They typically transfer stolen money to dummy accounts or pre-paid debit cards, but they\'ve also engaged in manipulating ATMs.The primary members of the groups were arrested and sentenced in 2018, but POS attacks later that year indicated that they could still pose a threat under the name FIN7.', image: '/pathtraversal/images/carbanak.jpg' },
            '5': { name: 'The Dark Overlord', description: 'The Dark Overlord group gained notoriety for its ruthless extortion and high-profile data breaches. They target organizations and individuals to steal sensitive data and then use that information to blackmail them. They have focused on medical databases and Hollywood production studios, often demanding large sums of money in exchange for not releasing the stolen data to the public.One of their most infamous attacks was the hack of Netflix\'s show "Orange Is the New Black," where they leaked unreleased episodes and demanded ransom. But among their most sinister are the attacks on healthcare providers, during which they stole sensitive patient information and threatened to expose it (even selling some on the dark web) unless their demands were met, as well as threats sent to school districts to extort parents.Their methods involve sophisticated cyber-espionage tools as well as social engineering, spear-phishing, exploiting zero-day exploits, and deploying ransomware.While Nathan Wyatt has been identified as The Dark Overlord and sentenced to prison, some cyber researchers believe the original culprits have gone on to found the hacking groups Gnostic Players, NSFW, and Shiny Hunters.', image: '/pathtraversal/images/TheDarkOverlord.jpg' },
            '6': { name: 'The Equation Group', description: 'The Equation Group is a cyber-espionage group believed to be linked to the United States National Security Agency\'s (NSA) Tailored Access Operations (TAO) unit. Active since at least 2001, they are suspected of being involved in the Stuxnet worm attack on Iran\'s nuclear facilities and have also targeted governments, military organizations, financial institutions, and telecommunications companies in Russia, Pakistan, Afghanistan, India, Syria, and Mali.One of their primary methods is using zero-day vulnerabilities to gain access to systems, allowing them to implant highly sophisticated and persistent malware like Flame, EquationDrug, and GrayFish, capable of reprogramming hard disk drive firmware to create hidden disk areas and virtual disk systems. The group\'s name originated from its extensive use of encryption, which makes detection challenging.In 2015, a group known as the Shadow Brokers claimed to have hacked the Equation Group and released some of their hacking tools, causing significant concern in the cybersecurity community.', image: '/pathtraversal/images/TheEquationGroup.jpg' },
            
            '7': { name: 'TA505 (Evil Corp)', description: 'TA505, also known as Evil Corp, has been active since at least 2009. The group has been linked to Russia and is known for its cyberattacks on financial institutions in the United States, United Kingdom, and Germany, as well as healthcare organizations, government agencies, and educational institutions.One of their primary tools is the Dridex banking Trojan, which they have used to steal login credentials, financial information, and other sensitive data from banks and financial institutions. TA505 has engaged in extensive wire fraud to steal from victims.TA505 also uses social engineering techniques to send millions of malicious emails, often impersonating well-known companies or entities to deceive victims into opening malicious attachments or clicking on malicious links to deliver various ransomware strains.', image: '/pathtraversal/images/ta505.jpg' },
            '8': { name: 'DarkSide', description: 'DarkSide is believed to be operating in Eastern Europe, specifically Russia. Their tools are ransomware attacks and extortion. In fact, this group operates using a "ransomware as a service" model, where they provide affiliates with access to their ransomware in return for a percentage of the ransom payments. These have been reported to be around 25% for amounts under $500,000 and 10% for larger sums above $5 million.DarkSide claims to be apolitical, and they avoid targeting certain geographic locations to exclude former Soviet countries. They also refrain from attacking healthcare centers, schools, and non-profit organizations.Their most notorious attack was the Colonial Pipeline cyberattack, after which they announced they were shutting down operations and disbanding their affiliate program. However, cybersecurity experts have suggested this might be a ploy to allow the group to reemerge under a different name.', image: '/pathtraversal/images/darkside.jpg' },
            '9': { name: 'Morpho', description: 'The origins and exact location of Morpho remain largely unknown. Capitalizing primarily on zero-day vulnerabilities, they target the intellectual property of government agencies, financial institutions, technology companies, and healthcare providers. Their most well-known attacks against Microsoft, Apple, Twitter, and Facebook took place in 2013.Morpho also uses social engineering and custom-built malware to breach the defenses of its targets and remain undetected for extended periods.Apprehending members of Morpho has proven challenging for cybersecurity experts and law enforcement agencies.', image: '/pathtraversal/images/morpho.jpg' },
            '10': { name: 'Lapsus$', description: 'Lapsus$ (aka DEV-0537) is an international hacker group with a focus on extortion. The group uses Telegram for public communication with its 50,000+ subscribers, including recruitment and posting sensitive data from their victims.In 2021, the group attacked the Brazilian Health Ministry, took down the website, and deleted sensitive data. More brazen attacks took place in 2022, first against large tech companies like Microsoft, Nvidia, and Samsung in March, and then again in September against Uber and Rockstar Games.Lapsus$ used social engineering to hack into access management company Okta, gain unauthorized access to Nvidia\'s systems, and access user data from the Mercado Libre online marketplace. They\'ve also employed multi-factor authentication (MFA) fatigue as a tactic in their attack on Uber.The group\'s mastermind turned out to be a 16-year-old from Oxford, England. While he was arrested in 2022, Lapsus$ remains a threat, and its members appear to be primarily teenagers from England and Portugal.', image: '/pathtraversal/images/Lapsus.jpg' },
        };

        return products[productId];
    }
</script>

</body>
</html>
