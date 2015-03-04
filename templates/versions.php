<dt>4 March</dt>
<dd>
  Released <a href="<?php echo htmlspecialchars(url_for("api")); ?>">initial API</a>;

  updated <a href="<?php echo htmlspecialchars(url_for("signup")); ?>">signup country list</a>;

  fixed <span class="currency_name_dog">DOGE</span> and <span class="currency_name_blk">BLK</span> address balances;

  fixed failing <a href="<?php echo htmlspecialchars(url_for("wizard_notifications")); ?>">notifications</a> sending invalid emails;

  completed more work in componentising the underlying <a href="http://openclerk.org">openclerk.org</a> application architecture.
</dd>

<dt>4 February</dt>
<dd>
  Added currency support for <a href="http://storj.io/" class="currency_name_sj1">StorjCoin</a>;

  added new block explorer for <span class="currency_name_hbn">HBN</span> addresses;

  <a href="<?php echo htmlspecialchars(url_for("historical")); ?>">exchange pairs</a> are now updated automatically;

  fixed test account buttons not displaying in <a href="<?php echo htmlspecialchars(url_for("wizard_accounts")); ?>">your accounts wizards</a>;

  updated <a href="<?php echo htmlspecialchars(url_for("features")); ?>">features list</a>.
</dd>

<dt>9 January</dt>
<dd>
  Added new block explorers for <span class="currency_name_vtc">VTC</span>, <span class="currency_name_mec">MEC</span>,
  <span class="currency_name_ixc">IXC</span>, <span class="currency_name_ftc">FTC</span> and <span class="currency_name_trc">TRC</span> addresses;

  rebranded Blackcoin from BC to <span class="currency_name_bc1">BLK</span>;

  email messages are now provided in both HTML and text;

  updated the list of <a href="<?php echo htmlspecialchars(url_for("help/cryptocurrencies")); ?>">cryptocurrency community resources</a>;

  released the <a href="http://openclerk.org" target="_blank">openclerk.org</a> project page;

  completed initial work in componentising the underlying <a href="http://openclerk.org">openclerk.org</a> application architecture.
</dd>

<dt>22 November</dt>
<dd>
  Added currency support for <a href="https://nubits.com/" class="currency_name_nbt">NuBits</a>
  and <a href="https://nubits.com/" class="currency_name_nsr">NuShares</a>;

  added <a href="https://bitnz.com/">BitNZ</a> exchange accounts;

  added <a href="https://bter.com/">BTER</a> exchange tickers;

  updated <a href="https://www.give-me-coins.com">Give Me Coins</a> supported currencies;

  disabled <a href="https://www.btcinve.com/">BTCInve</a> security exchange;

  graphs can now display two years of data;

  <a href="<?php echo htmlspecialchars(url_for('wizard_accounts')); ?>">your wizards</a> now display current balances for each account.
</dd>

<dt>7 November</dt>
<dd>
  Added currency support for <a href="https://www.reddcoin.com/" class="currency_name_rdd">Reddcoin</a>
  and <a href="http://viacoin.org/" class="currency_name_via">Viacoin</a>;

  added <a href="https://www.nicehash.com/">NiceHash</a>,
  <a href="https://westhash.com/">WestHash</a>,
  <a href="https://hash-to-coins.com/">Hash-to-coins</a> and
  <a href="https://www.eobot.com/">Eobot</a> mining pools;

  added <a href="https://btclevels.com/">BTClevels</a> accounts;

  disabled <a href="https://www.scryptguild.com/">ScryptGuild</a>,
  <a href="http://ltcmine.ru/">LTCMine.ru</a>,
  <a href="http://beeeeer.org/"><?php echo htmlspecialchars(get_exchange_name('beeeeer')); ?></a> and
  <a href="https://doge.rapidhash.net/">RapidHash</a> mining pools;

  fixed <span class="currency_name_xpm">XPM</span> addresses and
  <a href="https://nvc.khore.org">nvc.khore.org</a> accounts not updating;

  updated example graph images.
</dd>

<dt>10 September</dt>
<dd>
  Added currency support for <a href="https://www.darkcoin.io/" class="currency_name_drk">Darkcoin</a>,
  <a href="http://www.vericoin.info/" class="currency_name_vrc">Vericoin</a>,
  <a href="http://nxt.org/" class="currency_name_nxt">Nxt</a>,
  <span class="currency_name_dkk" title="<?php echo htmlspecialchars(get_currency_name('dkk')); ?>">DKK</span>
  and <span class="currency_name_inr" title="<?php echo htmlspecialchars(get_currency_name('inr')); ?>">INR</span>;

  rewrote graphing framework;

  added simple currency pair graphs for all exchange pairs;

  graphs can now be <a href="<?php echo htmlspecialchars(url_for('help/graph_refresh')); ?>">refreshed manually</a>;

  disabled <a href="http://pool.dogechain.info">Dogechain Pool</a>,
  <a href="https://hypernova.pw/">hypernova.pw</a>,
  <a href="http://dogepool.pw">dogepool.pw</a> and
  <a href="http://shibepool.com/">Shibe Pool</a> mining pools;

  notifications can now be <a href="<?php echo htmlspecialchars(url_for('wizard_notifications')); ?>">individually disabled</a>;

  automatic transactions have been disabled, but can be re-enabled through <a href="<?php echo htmlspecialchars(url_for('wizard_accounts')); ?>">your wizards</a>;

  you can now add <a href="<?php echo htmlspecialchars(url_for('wizard_accounts_offsets')); ?>">multiple named offsets</a> for each currency;

  fixed <span class="currency_name_dog">DOGE</span> addresses not updating;

  updated supported currencies from <a href="https://www.crypto-trade.com">Crypto-Trade</a>, <a href="https://cex.io">CEX.io</a> and other exchanges.
</dd>

<dt>24 July</dt>
<dd>
  Added currency support for <a href="http://www.blackcoin.co/" class="currency_name_bc1">Blackcoin</a>;
  added <a href="https://bittrex.com/">Bittrex</a> exchange;
  you can now <a href="<?php echo htmlspecialchars(url_for('vote_coins')); ?>">vote for new currencies</a> to be added;
  changed <span class="currency_name_nmc">NMC</span> addresses to use <a href="http://namecha.in/">Namecha.in</a>;
  changed <span class="currency_name_nvc">NVC</span> addresses to use <a href="https://explorer.novaco.in/">Novacoin explorer</a>;
  <span class="currency_name_xrp">Ripple</span> addresses will now also fetch non-XRP balances;
  improved notifications for <span class="currency_name_doge">DOGE</span> balances;
  disabled <a href="http://mining-foreman.org">Mining Foreman</a> mining pool;
  fixed <span class="currency_name_ixc">IXC</span> addresses not updating;
  updated icons in <a href="https://play.google.com/store/apps/details?id=com.cryptfolio.calculator">Crypto Converter</a> Android app.
</dd>

<dt>25 June</dt>
<dd>
Added currency support for <span class="currency_name_sgd" title="<?php echo htmlspecialchars(get_currency_name('sgd')); ?>">SGD</span>;
added <a href="https://www.itbit.com/">itBit</a> exchange ticker;
changed <span class="currency_name_ppc">PPC</span> and <span class="currency_name_dgc">DGC</span> addresses to use <a href="http://blockr.io/">Blockr.io</a>;
changed <span class="currency_name_wdc">WDC</span> addresses to use <a href="http://www.worldcoinexplorer.com/">Worldcoin Explorer</a>;
site design is now slightly more responsive;
user accounts can now be <a href="<?php echo htmlspecialchars(url_for('user#user_delete')); ?>">deleted</a>;
created the <a href="http://blog.cryptfolio.com">CryptFolio blog</a>.
</dd>

<dt>28 May</dt>
<dd>
Added <a href="https://anxpro.com/">ANXPRO</a>, <a href="https://www.bitmarket.pl/">BitMarket.pl</a>, <a href="https://www.poloniex.com/">Poloniex</a> exchanges;
updated <a href="https://cex.io/">CEX.io</a> supported currencies;
added <a href="https://mupool.com/">MuPool</a> mining pool.
</dd>


<!-- more are in versions_old -->
